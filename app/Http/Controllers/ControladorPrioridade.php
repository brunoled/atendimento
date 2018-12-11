<?php

namespace App\Http\Controllers;

use App\Prioridade;
use Illuminate\Http\Request;

class ControladorPrioridade extends Controller
{

    public function indexView()
    {
        $prioridades = Prioridade::all();
        return view('prioridade', compact('prioridades'));
    }

    public function index()
    {
        $prioridades = Prioridade::all();
        return $prioridades->toJson();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Prioridade();
        $p->prioridade = $request->input('prioridade');
        $p->save();
        return json_encode($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prior = Prioridade::find($id);
        if(isset($prior)){
            return json_encode($prior);
        }
        return response("Prioridade não encontrada", 404);
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
        $prior = Prioridade::find($id);
        if(isset($prior)){
            $prior->prioridade = $request->input('prioridade');
            $prior->save();
            return json_encode($prior);
        }
        return response("Prioridade não encontrada", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prioridade = Prioridade::find($id);
        if(isset($prioridade)){
            $prioridade->delete();
            return response('OK',200);
        }
        return response("Prioridade não encontrada", 404);
    }
}
