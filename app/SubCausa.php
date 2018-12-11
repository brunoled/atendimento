<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCausa extends Model
{
    public function causa(){
        return $this->belongsTo('App\Causa');
    }

    function atendimento() {
        return $this->hasMany('App\Atendimento');
    }
}
