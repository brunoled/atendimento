<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    function atendimento() {
        return $this->hasMany('App\Atendimento');
    }
}
