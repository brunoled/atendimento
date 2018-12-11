@extends('layout.app', ["current" => "home"])

@section('title')
    Atendimentos
@endsection

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border-primary">
                    <h5 class="card-title">Atendimento</h5>
                    <table class="table table-ordered table-hover" id="tabelaAtendimento">
                        <thead>
                        <tr>
                            <th>Nº ticket</th>
                            <th>Cliente</th>
                            <th>Tipo de atendimento</th>
                            <th>Atendente</th>
                            <th>Status</th>
                            <th>Descrição</th>
                            <th>Prioridade</th>
                            <th>Causa</th>
                            <th>Detalhe da Causa</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Ocorrências</h5>
            <table class="table table-ordered table-hover" id="tabelaOcorrencias">
                <thead>
                <tr>
                    <th>Nº ticket</th>
                    <th>Atendente</th>
                    <th>Causa</th>
                    <th>Detalhe da Causa</th>
                    <th>Detalhes da Ocorrencia</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="cadOcorrencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formOcorrencia">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Ocorrência</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        {{--<div class="form-group">--}}
                        {{--<label for="tipo_atd_id">Tipo de Atendimento</label>--}}
                        {{--<select id="tipo_atd_id" class="form-control">--}}

                        {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="atendente">Direcionar a:</label>
                            <input type="text" placeholder="Atendente" id="atendente" class="form-control">
                        </div>
                        {{--<div class="form-group">--}}
                        {{--<label for="descricao">Descrição</label>--}}
                        {{--<textarea rows="3" class="form-control" id="descricao"></textarea>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="prioridade_id">Prioridade</label>--}}
                        {{--<select class="form-control" id="prioridade_id">--}}

                        {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="causa_id">Causa</label>
                            <select class="form-control" id="causa_id" onchange="carregarSubCausa()">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcausa_id">Especificação da Causa</label>
                            <select id="subcausa_id" class="form-control">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Detalhes da Ocorrência: </label>
                            <textarea rows="3" class="form-control" id="descricao"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        function carregarAtendimento(p)
        {
            $.getJSON('api/atendimento/'+p.atendimento.id, function(data){
             var linha =   "<td>" + p.id + "</td>" +
                "<td style='font-weight: bold'>" + p.cliente.nome + "</td>" +
                "<td>" + p.tipo_atd.tipo_atd + "</td>" +
                "<td>" + p.atendente + "</td>" +
                "<td>" + p.status.status + "</td>" +
                "<td id='desc'>" + p.descricao + "</td>" +
                "<td>" + p.prioridade.prioridade + "</td>" +
                "<td>" + p.causa.causa + "</td>" +
                "<td>" + p.subcausa.subcausa + "</td>" +
                "</tr>";
            });
        }

    </script>


@endsection
