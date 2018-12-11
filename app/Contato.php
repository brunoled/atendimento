<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'clientes';

    function atendimento(){
        return $this->hasMany('App\Atendimento');
    }
}
