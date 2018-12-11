@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você logou com sucesso! Bem vindo {{ Auth::user()->usuario }}


                    <a href="/" class="btn btn-primary">Ir para atendimentos</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
