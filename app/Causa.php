<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    function subcausa() {
        return $this->hasMany('App\SubCausa');
    }

    function atendimento() {
        return $this->hasMany('App\Atendimento');
    }
}
