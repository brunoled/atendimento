@extends('layout.app', ["current" => "home"])

@section('title')
    Atendimentos
@endsection

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Atendimento</h5>
                        <p class="card-text">
                            Cadastre um atendimento por aqui
                        </p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" role="button" onclick="novoAtendimento()">Novo Atendimento</button>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Buscar Atendimento</h5>
                        <p class="card-text">
                        <form action="" id="formBuscar">
                            <input type="text" class="form-control" id="search"><span class="input-group-btn"></span>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="id_buscar" id="id_buscar" value="checkedValue"
                                           checked>
                                    Ticket
                                </label>
                            </div>

                        </form>
                        </p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Atendimentos</h5>
            <table class="table table-ordered table-hover" id="tabelaAtendimentos">
                <thead>
                    <tr>
                        <th>Nº ticket</th>
                        <th>Cliente</th>
                        <th>Tipo de atendimento</th>
                        <th>Atendente</th>
                        {{--<th>Status</th>--}}
                        <th>Descrição</th>
                        <th>Prioridade</th>
                        <th>Causa</th>
                        <th>Detalhe da Causa</th>
                        <th>Atendimento inicial</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    
    <div class="modal" tabindex="-1" role="dialog" id="cadAtendimento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formAtendimento">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Atendimento</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <input type="hidden" id="status_id" class="form-control" value="1">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <input list="cliente" id="cliente_id" class="form-control"/>
                            <datalist id="cliente">

                            </datalist>

                        </div>
                        <div class="form-group">
                            <label for="tipo_atd_id">Tipo de Atendimento</label>
                            <select id="tipo_atd_id" class="form-control">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="atendente">Atendente</label>
                            <input type="text" placeholder="Atendente" id="atendente" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea rows="3" class="form-control" id="descricao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="prioridade_id">Prioridade</label>
                            <select class="form-control" id="prioridade_id">

                            </select>
                        </div>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="mostraOcorrencias">
        <div class="modal-dialog" style="max-width: 1000px" role="document">
            <div class="modal-content">
                <div class="card border">
                    <div class="card-body">
                        <h5 class="card-title">Ocorrências</h5>
                        <table class="table table-ordered table-hover" id="tabelaOcorrencias">
                            <thead>
                            <tr>
                                <th>Nº Ocorrência</th>
                                <th>Atendente</th>
                                <th>Causa</th>
                                <th>Detalhe da Causa</th>
                                <th>Detalhes da Ocorrencia</th>
                                <th>Dia do atendimento</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyOcorrencia">

                            </tbody>
                        </table>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" onclick="novaOcorrencia()">Cadastrar Nova Ocorrência</button>
                            <button type="submit" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

                        <form action="" class="form-horizontal" id="formOcorrencia" style="display: none">
                            <div class="modal-header">
                                <h5 class="modal-title">Nova Ocorrência</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="atendimento_id" class="form-control">
                                <div class="form-group">
                                    <label for="atendente_ocor">Direcionado a:</label>
                                    <input type="text" placeholder="Atendente" id="atendente_ocor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="detalhes">Detalhes</label>
                                    <textarea rows="3" class="form-control" id="detalhes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="causa_id">Causa</label>
                                    <select class="form-control" id="causa_id_ocor" onchange="carregarSubCausaOcor()">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subcausa_id_ocor">Especificação da Causa</label>
                                    <select id="subcausa_id_ocor" class="form-control">

                                    </select>
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

        function carregarAtendimentos()
        {
            $.getJSON('api/atendimento', function(data){
                for(i=0;i<data.length;i++)
                {
                    linha = montarLinha(data[i]);
                    $('#tabelaAtendimentos>tbody').append(linha);

                }
            });
        }


        function montarLinha(p){

            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td style='font-weight: bold'>" + p.cliente.nome + "</td>" +
                "<td>" + p.tipo_atd.tipo_atd + "</td>" +
                "<td>" + p.atendente.atendente + "</td>" +
                // "<td>" + p.status.status + "</td>" +
                "<td id='desc'>" + p.descricao + "</td>" +
                "<td>" + p.prioridade.prioridade + "</td>" +
                "<td>" + p.causa.causa + "</td>" +
                "<td>" + p.subcausa.subcausa + "</td>" +
                "<td>" + p.created_at + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="mostraOcorrencias('+ p.id +')"> Mostrar Ocorrência </button> ' +
                '<button class="btn btn-sm btn-danger" onclick="fechaAtd('+ p.id + ')"> Fechar Atendimento</button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }


        function montaLinhaOcorrencia(p)
        {
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.atendente + "</td>" +
                "<td>" + p.causa.causa + "</td>" +
                "<td>" + p.subcausa.subcausa + "</td>" +
                "<td>" + p.detalhes + "</td>" +
                "<td>" + p.created_at + "</td>" +
                "</tr>";
            return linha;
        }

        function mostraOcorrencias(id)
        {

            var tabela = document.getElementById('tbodyOcorrencia');
            while(tabela.rows.length > 0){
                tabela.deleteRow(0);
            }
            $.getJSON('api/ocorrencia', function(data){
                for(i=0;i<data.length;i++)
                {
                    if(data[i].atendimento_id == id)
                    {
                        linha = montaLinhaOcorrencia(data[i]);
                        $('#tabelaOcorrencias>tbody').append(linha);
                    }
                }
            })
            $('#mostraOcorrencias').modal('show');
            $('#atendimento_id').val(id);
        }

        function novoAtendimento() {
            $("#id").val('');
            $('#cliente').val('');
            $('#tipo_atd_id').val('');
            $('#atendente').val('');
            $('#descricao').val('');
            $('#prioridade_id').val('');
            $('#causa_id').val('');
            $('#subcausa_id').val('');
            $('#cadAtendimento').modal('show');
        }

        function novaOcorrencia() {
            if(document.getElementById('formOcorrencia').style.display == 'none')
            {
                $('#atendente_ocor').val('');
                $('#detalhes').val('');
                $('#causa_id_ocor').val('');
                $('#subcausa_id_ocor').val('');
                document.getElementById('formOcorrencia').style.display = 'block'
            }else {
                $('#atendente_ocor').val('');
                $('#detalhes').val('');
                $('#causa_id_ocor').val('');
                $('#subcausa_id_ocor').val('');
                document.getElementById('formOcorrencia').style.display = 'none'
            }
        }

        function carregarClientes() {
            $.getJSON('/api/contato', function(data){
                for(i=0; i<data.length;i++){
                    opcao = '<option data-value="' + data[i].id + '" value="' +
                            data[i].nome + '"></option>';
                    $('#cliente').append(opcao);
                }
            });
        }

        function carregarTipoAtd()
        {
            $.getJSON('/api/adm/tipo-atd', function(data){
                for (i=0;i<data.length;i++){
                    opcao = '<option value="' + data[i].id + '">' +
                            data[i].tipo_atd + '</option>';
                    $('#tipo_atd_id').append(opcao);
                }
            });
        }
        function carregarPrioridade()
        {
            $.getJSON('/api/adm/prioridades', function(data){
                for (i=0;i<data.length;i++){
                    opcao = '<option value="' + data[i].id + '">' +
                        data[i].prioridade + '</option>';
                    $('#prioridade_id').append(opcao);
                }
            });
        }

        function carregarCausa()
        {
            $.getJSON('/api/adm/causas', function(data){
                for (i=0;i<data.length;i++) {
                    opcao = '<option value="' + data[i].id + '">' +
                        data[i].causa + '</option>';
                    $('#causa_id').append(opcao);
                }
            });
        }

        function carregarCausaOcor()
        {
            $.getJSON('/api/adm/causas', function(data){
                for (i=0;i<data.length;i++) {
                    opcao = '<option value="' + data[i].id + '">' +
                        data[i].causa + '</option>';
                    $('#causa_id_ocor').append(opcao);
                }
            });
        }


        function carregarSubCausa()
        {
            $('#subcausa_id').empty();

            if($('#causa_id').val() != '')
            {
                $.getJSON('api/adm/causas/sub/'+$('#causa_id').val(), function (data){
                    for(i=0;i<data.length;i++){
                        opcao = '<option id="opt'+ i + '" value="' + data[i].id + '">' +
                            data[i].subcausa + '</option>';
                        $('#subcausa_id').append(opcao);
                    }
                })
            }
        }

        function carregarSubCausaOcor()
        {
            $('#subcausa_id').empty();

            if($('#causa_id').val() != '')
            {
                $.getJSON('api/adm/causas/sub/'+$('#causa_id').val(), function (data){
                    for(i=0;i<data.length;i++){
                        opcao = '<option id="opt'+ i + '" value="' + data[i].id + '">' +
                            data[i].subcausa + '</option>';
                        $('#subcausa_id_ocor').append(opcao);
                    }
                })
            }
        }

        function criarAtendimento()
        {
            if(($('#cliente_id').val())){
                var valor = document.getElementById('cliente_id').value;
                var x = document.querySelector("#cliente option[value='"+valor+"']").dataset.value;
                document.getElementById('cliente_id').value = x;
            }
            atd = {
                cliente_id: $('#cliente_id').val(),
                tipo_atd_id: $('#tipo_atd_id').val(),
                atendente: $('#atendente').val(),
                status_id: $('#status_id').val() ,
                descricao: $('#descricao').val(),
                prioridade_id: $('#prioridade_id').val(),
                causa_id: $('#causa_id').val(),
                subcausa_id: $('#subcausa_id').val()
            };
            console.log(atd);
            // $.post("api/atendimento", atd, function(data){
            //     atendimento = JSON.parse(data);
            //     linha = montarLinha(atendimento);
            //     $('#tabelaAtendimentos>tbody').append(linha);
            // });

            $.ajax({
                url: '/api/atendimento/',
                type: 'POST',
                context: this,
                data: atd,
                success: function(data){
                    atd = JSON.parse(data);
                    linha = montarLinha(atd);
                    $('#tabelaAtendimentos>tbody').append(linha);
                    console.log("Adicionado");
                },
                error: function (request) {
                    if(request.status == 422)
                    {
                        var errors = request.responseJSON.errors;
                        var errorsHTML = '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-times"></i>Preencha o formulário corretamente</h4><ul>';
                        $.each(errors, function(key, value){
                            $.each(value, function(key2, error){
                                errorsHTML += '<li>' + error + '</li>';
                            });
                        });
                        errorsHTML += '</ul></div>';
                        $('#formAtendimento').append(errorsHTML);
                    }

                }

            });


        }

        function criarOcorrencia()
        {
            ocor = {
                atendimento_id: $('#atendimento_id').val(),
                atendente: $('#atendente_ocor').val(),
                detalhes: $('#detalhes').val(),
                causa_id: $('#causa_id_ocor').val(),
                subcausa_id: $('#subcausa_id_ocor').val()
            }
            $.ajax({
                url: '/api/ocorrencia/',
                type: 'POST',
                context: this,
                data: ocor,
                success: function (data) {
                    ocor = JSON.parse(data);
                    linha = montaLinhaOcorrencia(ocor);
                    $('#tabelaOcorrencias>tbody').append(linha);
                },
                error: function(request){
                    if(request.status == 422)
                    {
                        var errors = request.responseJSON.errors;
                        var errorsHTML = '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-times"></i>Preencha o formulário corretamente</h4><ul>';
                        $.each(errors, function(key, value){
                            $.each(value, function(key2, error){
                                errorsHTML += '<li>' + error + '</li>';
                            });
                        });
                        errorsHTML += '</ul></div>';
                        $('#formOcorrencia').append(errorsHTML);
                    }
                }
            });

        }

        function fechaAtd(id){
            atd = {
                id: id,
                status_id: 2
            };
            $.ajax({
                type: "PUT",
                url: "/api/atendimento/"+id,
                context: this,
                data: atd,
                success: function(data) {
                    atd = JSON.parse(data);
                    linhas = $("#tabelaAtendimentos>tbody>tr")
                    e = linhas.filter(function(i,e){
                        return(e.cells[0].textContent == id)
                    });
                    if(e)
                    {
                        e[0].cells[4].textContent = "Fechado";
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });

        }

        $("#formAtendimento").submit(function (event){
            event.preventDefault();
            criarAtendimento();

            //$("#cadAtendimento").modal('hide');
        });

        $("#formOcorrencia").submit(function (event){
            event.preventDefault();
            criarOcorrencia();
        });

        // $("#formBuscar").submit(function(event){
        //     event.preventDefault();
        //     buscarAtendimento($('#buscar').val());
        // })

        $('#search').on('keyup', function(){
            $value = $(this).val();
            if($value == '')
            {
                $('#tabelaAtendimentos>tbody').html('');

                carregarAtendimentos();
            } else {
                $.ajax({
                    type: 'get',
                    url : '{{URL::to('search')}}',
                    data: {'search': $value},
                    success: function(data){
                        $('#tabelaAtendimentos>tbody').html(data);
                    },
                    error: function(error)
                    {
                        console.log(error);
                    }
                });

            }
        });



        $(function () {
            carregarClientes();
            carregarTipoAtd();
            carregarPrioridade();
            carregarCausa();
            carregarCausaOcor();
            carregarAtendimentos();
            //carregarSubCausa()
        })
    </script>


@endsection
