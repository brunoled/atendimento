<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario', 'password'
    ];

    protected $hidden = [
        'senha', 'remember_token'
    ];

//    public function getAuthPassword()
//    {
//        return $this->password;
//    }
}
