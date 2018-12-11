@extends('layout.app', ["current" => "adm"])

@section('title')
    Painel Administrativo - Tipos de Atendimento
@endsection

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Tipo de Atendimento</h5>
            <table class="table table-ordered table-hover" id="tabelaTipoAtd">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Tipo de Atendimento</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novoTipoAtd()">Novo Tipo de Atendimento</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgTipoAtd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formTipoAtd">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Tipo de Atendimento</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="tipoAtd" class="control-label">Tipo de Atendimento</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tipoAtd" placeholder="Tipo de atendimento">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
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


        function novoTipoAtd() {
            $('#id').val('');
            $('#tipoAtd').val('');
            $('#dlgTipoAtd').modal('show');
        }


        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.tipo_atd + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar('+ p.id +')"> Editar </button> ' +
                '<button class="btn btn-sm btn-danger" onclick="remover('+ p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }

        function editar(id) {
            $.getJSON('/api/adm/tipo-atd/'+id, function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#tipoAtd').val(data.tipo_atd);
                $('#dlgTipoAtd').modal('show');
            });

        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/adm/tipo-atd/" + id,
                context: this,
                success: function() {
                    console.log("Apagado")
                    linhas = $("#tabelaPrioridade>tbody>tr")
                    e = linhas.filter(function(i, elemento){
                        return elemento.cells[0].textContent == id;
                    });
                    if(e)
                        e.remove();
                },
                error: function (error) {
                    console.log(error);

                }
            })

        }

        function carregarTipoAtd() {
            $.getJSON('/api/adm/tipo-atd', function(data){
                for(i=0; i<data.length;i++){
                    linha = montarLinha(data[i]);
                    $('#tabelaTipoAtd>tbody').append(linha);
                }
            });
        }

        function criarTipoAtd() {
            tipoatd = {
                tipo_atd: $('#tipoAtd').val()
            };
            $.post("/api/adm/tipo-atd", tipoatd, function(data){
                tipoatds = JSON.parse(data);
                linha = montarLinha(tipoatds);
                $('#tabelaTipoAtd>tbody').append(linha);
            });
        }

        function salvarTipoAtd() {
            tipoatd = {
                id: $("#id").val(),
                tipo_atd: $("#tipoAtd").val()
            };
            $.ajax({
                url: "/api/adm/tipo-atd/" + tipoatd.id,
                type: "PUT",
                context: this,
                data: tipoatd,
                success: function(data){
                    tipoatd = JSON.parse(data);
                    linhas = $("#tabelaTipoAtd>tbody>tr")
                    e = linhas.filter(function(i,e){
                        return(e.cells[0].textContent == tipoatd.id);
                    });
                    if(e) {
                        e[0].cells[0].textContent = tipoatd.id;
                        e[0].cells[1].textContent = tipoatd.tipo_atd;
                    }
                    console.log("Salvou OK");
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $("#formTipoAtd").submit( function (event) {
            event.preventDefault();
            if($("#id").val() != '')
                salvarTipoAtd();
            else
                criarTipoAtd();
            $("#dlgTipoAtd").modal('hide');

        });

        $(function(){
            carregarTipoAtd();
        })

    </script>

@endsection