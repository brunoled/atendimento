<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAtd extends Model
{
    function atendimento() {
        return $this->hasMany('App\Atendimento');
    }

}
