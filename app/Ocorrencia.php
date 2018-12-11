<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    public function atendimento(){
        return $this->belongsTo('App\Atendimento');
    }
    function causa()
    {
        return $this->belongsTo('App\Causa');
    }
    function subcausa()
    {
        return $this->belongsTo('App\SubCausa');
    }
    public function atendente()
    {
        return $this->belongsTo('App\Atendente');
    }
}
