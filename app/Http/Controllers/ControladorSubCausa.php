<?php

namespace App\Http\Controllers;

use App\Causa;
use App\SubCausa;
use Illuminate\Http\Request;

class ControladorSubCausa extends Controller
{

    public function indexView()
    {
        $subcausas = SubCausa::all();
        return view('subtipo', compact('subcausas'));
    }

    public function index()
    {
        $subcausas = SubCausa::with('causa')->get();
        return $subcausas->toJson();
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
        $s = new SubCausa();
        $s->subcausa = $request->input('subcausa');


        $causa_id = $request->input('causa_id');
        $causa = Causa::find($causa_id);
        $s->causa()->associate($causa);
        $s->save();
        return json_encode($s);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcausas = SubCausa::find($id);
        if(isset($subcausas)){
            return json_encode($subcausas);
        }
        return response("SubCausa não encontrada", 404);
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
        $subcausa = SubCausa::find($id);
        if(isset($subcausa)){
            $subcausa->subcausa = $request->input('subcausa');
            $subcausa->causa_id = $request->input('causa_id');
            $subcausa->save();
            return json_encode($subcausa);
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
        $subcausa = SubCausa::find($id);
        if(isset($subcausa)){
            $subcausa->delete();
            return response('OK',200);
        }
        return response('Causa não encontrada', 404);
    }
}
