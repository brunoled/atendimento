<?php

namespace App\Http\Controllers;

use App\TipoAtd;
use Illuminate\Http\Request;


class ControladorTipoAtd extends Controller
{

    public function indexView()
    {
        $tatd = TipoAtd::all();
        return view('tipo-atd', compact('tatd'));
    }


    public function index()
    {
        $tatd = TipoAtd::all();
        return $tatd->toJson();
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
        $t = new TipoAtd();
        $t->tipo_atd = $request->input('tipo_atd');
        $t->save();
        return json_encode($t);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_atd = TipoAtd::find($id);
        if(isset($tipo_atd)){
            return json_encode($tipo_atd);
        }
        return response("Tipo de atendimento não encontrado", 404);
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
        $tipo_atd = TipoAtd::find($id);
        if(isset($tipo_atd)){
            $tipo_atd->tipo_atd = $request->input('tipo_atd');
            $tipo_atd->save();
            return json_encode($tipo_atd);
        }
        return response("Tipo de atendimento não encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_atd = TipoAtd::find($id);
        if(isset($tipo_atd)){
            $tipo_atd->delete();
            return response('OK', 200);
        }
        return response("Tipo de atendimento não encontrado.", 404);
    }
}
