<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'usuario';
    }

    public function messages()
    {
        return [
            'usuario.required' => 'Digite um usuário.',
            'usuario.string' => 'Digite um usuário válido.',
            'password.required' => 'Digite uma senha.',
            'password.string' => 'Digite uma senha válida.'
        ];
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request,[
            $this->username() => 'required|string',
            'password' => 'required|string'
        ], $this->messages());
    }



}
