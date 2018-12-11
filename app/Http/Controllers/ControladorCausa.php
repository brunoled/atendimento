<?php

namespace App\Http\Controllers;

use App\Causa;
use Illuminate\Http\Request;

class ControladorCausa extends Controller
{

    public function buscaSub($causaid)
    {

        $sub = Causa::with('subcausa')->find($causaid);
        return $sub->subcausa->toJson();

    }


    public function indexView()
    {
        $causas = Causa::all();
        return view('causas', compact('causas'));
    }

    public function index()
    {
        $causas = Causa::all();
        return $causas->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c = new Causa();
        $c->causa = $request->input('causa');
        $c->save();
        return json_encode($c);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $causa = Causa::find($id);
        if(isset($causa)){
            return json_encode($causa);
        }
        return response("Causa não encontrada", 404);
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
        $causa = Causa::find($id);
        if(isset($causa)){
            $causa->causa = $request->input('causa');
            $causa->save();
            return json_encode($causa);
        }
        return response("Causa não encontrada", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $causa = Causa::find($id);
        if(isset($causa)){
            $causa->delete();
            return response('OK',200);
        }
        return response('Causa não encontrada', 404);
    }
}
