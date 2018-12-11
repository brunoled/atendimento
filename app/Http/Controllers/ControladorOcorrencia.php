<?php

namespace App\Http\Controllers;

use App\Atendimento;
use App\Causa;
use App\Ocorrencia;
use App\SubCausa;
use Illuminate\Http\Request;


class ControladorOcorrencia extends Controller
{

    public function indexView()
    {
        $ocorrencia = Ocorrencia::all();
        return view('ocorrencias', compact('ocorrencia'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ocorrencia = Ocorrencia::with('atendimento', 'causa', 'subcausa')->get();
        return $ocorrencia->toJson();
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
            'atendente.required' => 'Escolha um atendente.',
            'detalhes.required' => 'Digite uma descrição.',
            'detalhes.max' => 'A descrição não pode passar de 255 caracteres.',
            'causa_id.required' => 'Escolha uma causa, caso não tenha na seleção cadastre uma nova.',
            'subcausa_id.required' => 'Escolha um detalhamento da causa, caso não tenha na seleção cadastre uma nova.'
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'atendente' => 'required',
            'detalhes' => 'required|max:255',
            'causa_id' => 'required',
            'subcausa_id' => 'required'
        ], $this->messages());


        $ocor = new Ocorrencia();

        $atendimento_id = $request->input('atendimento_id');
        $atendimento = Atendimento::find($atendimento_id);
        $ocor->atendimento()->associate($atendimento);

        $ocor->atendente = $request->input('atendente');

        $causa_id = $request->input('causa_id');
        $causa = Causa::find($causa_id);
        $ocor->causa()->associate($causa);

        $subcausa_id = $request->input('subcausa_id');
        $subcausa = SubCausa::find($subcausa_id);
        $ocor->subcausa()->associate($subcausa);

        $ocor->detalhes = $request->input('detalhes');

        $ocor->save();

        return json_encode($ocor);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ocorrencia = Ocorrencia::find($id)->with('causa', 'subcausa', 'atendimento')->get();
        if(isset($ocorrencia)){
            return json_encode($ocorrencia);
        }

        return response('Ocorrência não encontrada',404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
