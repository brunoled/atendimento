@extends('layout.app', ["current" => "adm"])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Prioridades</h5>
                        <p class="card-text">
                            Cadastre os valores de prioridades dos atendimentos.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/adm/prioridades" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Tipos de Atendimento</h5>
                        <p class="card-text">
                            Aqui você cadastra os tipos de atendimentos.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/adm/tipo-atd" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Causas</h5>
                        <p class="card-text">
                            Aqui você cadastra as causas para o atendimento.
                        </p>

                    </div>
                    <div class="card-footer">
                        <a href="/adm/causas" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de subtipos de causas</h5>
                        <p class="card-text">
                            Aqui você cadastra os subtipos de causas
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/adm/subtipo" class="btn btn-primary">Cadastrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection