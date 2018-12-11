<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Causa;
use App\Contato;
use App\Prioridade;
use App\Status;
use App\SubCausa;
use App\TipoAtd;
use Illuminate\Http\Request;
use Validator;

class ControladorAtendimento extends Controller
{
    public function indexView()
    {
        $atendimento = Atendimento::all();
        return view('atendimento', compact('atendimento'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atendimento = Atendimento::with('cliente', 'causa', 'subcausa', 'prioridade', 'status', 'tipo_atd')->get();
        return $atendimento->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function messages()
    {
        return [
            'cliente_id.required' => 'Escolha um cliente.',
            'tipo_atd_id.required' => 'Escolha um tipo de atendimento.',
            'atendente.required' => 'Escolha um atendente.',
            'descricao.required' => 'Digite uma descrição.',
            'descricao.max' => 'A descrição não pode passar de 255 caracteres.',
            'prioridade_id.required' => 'Escolha um nível de prioridade.',
            'causa_id.required' => 'Escolha uma causa, caso não tenha na seleção cadastre uma nova.',
            'subcausa_id.required' => 'Escolha um detalhamento da causa, caso não tenha na seleção cadastre uma nova.'
        ];
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'cliente_id' => 'required',
            'tipo_atd_id' => 'required',
            'atendente' => 'required',
            'descricao' => 'required|max:255',
            'prioridade_id' => 'required',
            'causa_id' => 'required',
            'subcausa_id' => 'required'
        ], $this->messages());

        $atd = new Atendimento();

        $cliente_id = $request->input('cliente_id');
        $cliente = Contato::find($cliente_id);
        $atd->cliente()->associate($cliente);

        $tipo_atd_id = $request->input('tipo_atd_id');
        $tipoatd = TipoAtd::find($tipo_atd_id);
        $atd->tipo_atd()->associate($tipoatd);

        $atd->atendente = $request->input('atendente');

        $status_id = $request->input('status_id');
        $status = Status::find($status_id);
        $atd->status()->associate($status);

        $atd->descricao = $request->input('descricao');

        $prioridade_id = $request->input('prioridade_id');
        $prioridade = Prioridade::find($prioridade_id);
        $atd->prioridade()->associate($prioridade);

        $causa_id = $request->input('causa_id');
        $causa = Causa::find($causa_id);
        $atd->causa()->associate($causa);

        $subcausa_id = $request->input('subcausa_id');
        $subcausa = SubCausa::find($subcausa_id);
        $atd->subcausa()->associate($subcausa);

        $atd->save();


        return json_encode($atd);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atendimentos = Atendimento::find($id)->with('cliente', 'causa', 'subcausa', 'prioridade', 'status', 'tipo_atd')->where('id', $id)->get();

        if(isset($atendimentos)){
            return json_encode($atendimentos);
        }

        return response("Atendimento não encontrado", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $atd = Atendimento::find($id);
        if(isset($atd)){
            $atd->status_id = 2;
            $atd->save();
            return json_encode($atd);
        }
        return response("Atendimento não encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $saida="";
            $atendimentos = Atendimento::find($request->search)->with('cliente', 'causa', 'subcausa', 'prioridade', 'status', 'tipo_atd')->where('id', $request->search)->get();

            if($atendimentos)
            {
                foreach($atendimentos as $key => $a)
                {
                    $saida .= "<tr>" .
                        "<td>" . $a->id . "</td>" .
                        "<td style='font-weight: bold'>" . $a->cliente->nome . "</td>" .
                        "<td>" . $a->tipo_atd->tipo_atd . "</td>" .
                        "<td>" . $a->atendente . "</td>" .
                        // "<td>" . p.status.status . "</td>" .
                        "<td id='desc'>" . $a->descricao . "</td>" .
                        "<td>" . $a->prioridade->prioridade . "</td>" .
                        "<td>" . $a->causa->causa . "</td>" .
                        "<td>" . $a->subcausa->subcausa . "</td>" .
                        "<td>" . $a->created_at . "</td>" .
                        "<td>" .
                        '<button class="btn btn-sm btn-primary" onclick="mostraOcorrencias('. $a->id .')"> Mostrar Ocorrência </button> ' .
                        '<button class="btn btn-sm btn-danger" onclick="fechaAtd('. $a->id . ')"> Fechar Atendimento</button> ' .
                        "</td>" .
                        "</tr>";
                }
                return Response($saida);
            }
        }
    }
}
