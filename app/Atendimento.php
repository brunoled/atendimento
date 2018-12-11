<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = [
        'cliente_id',
        'tipo_atd_id',
        'atendente',
        'status_id',
        'descricao',
        'prioridade_id',
        'causa_id',
        'subcausa_id'
        ];


    function cliente()
    {
        return $this->belongsTo('App\Contato');
    }
    function causa()
    {
        return $this->belongsTo('App\Causa');
    }
    function subcausa()
    {
        return $this->belongsTo('App\SubCausa');
    }
    function prioridade()
    {
        return $this->belongsTo('App\Prioridade');
    }
    function status()
    {
        return $this->belongsTo('App\Status');
    }
    function tipo_atd()
    {
        return $this->belongsTo('App\TipoAtd');
    }

    function atendente()
    {
        return $this->belongsTo('App\Atendente');
    }

    function ocorrencia()
    {
        return $this->hasMany('App\Ocorrencia');
    }
}
