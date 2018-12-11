<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prioridade extends Model
{
    function atendimento() {
        return $this->hasMany('App\Atendimento');
    }
}
