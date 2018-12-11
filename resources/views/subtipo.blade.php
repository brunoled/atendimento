@extends('layout.app', ["current" => "adm"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Sub tipo de Causas</h5>
            <table class="table table-ordered table-hover" id="tabelaSubCausas">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Sub tipo Causa</th>
                    <th>Id Causa</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novaSubCausa()">Novo Sub tipo de Causa</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgSubCausas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formSubCausas">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Sub Tipo de Causa</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="subcausaid" class="control-label">Sub tipo Causa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="subcausaid" placeholder="Sub tipo de Causa">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="causa_id" class="control-label">Sub tipo Causa</label>
                            <div class="input-group">
                                <select class="form-control" id="causa_id">

                                </select>
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


        function novaSubCausa() {
            $('#id').val('');
            $('#subcausaid').val('');
            $('#causa_id').val('');
            $('#dlgSubCausas').modal('show');
        }

        function carregarSubCausas() {

            $.getJSON('/api/adm/subtipo', function(data){
                for(i=0; i<data.length;i++){
                    linha = montarLinha(data[i]);
                    $('#tabelaSubCausas>tbody').append(linha);
                }
            });
        }

        function carregarCausas() {
            $.getJSON('/api/adm/causas', function(data){
                for(i=0; i<data.length;i++){
                    opcao = '<option value = "' + data[i].id + '">' +
                    data[i].causa + '</option>';
                    $('#causa_id').append(opcao);
                }
            });
        }

        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.subcausa + "</td>" +
                "<td>" + p.causa.causa + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar('+ p.id +')"> Editar </button> ' +
                '<button class="btn btn-sm btn-danger" onclick="remover('+ p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }

        function editar(id) {
            $.getJSON('/api/adm/subtipo/'+id, function(data){
                $('#id').val(data.id);
                $('#subcausaid').val(data.subcausa);
                $('#causa_id').val(data.causa_id);
                $('#dlgSubCausas').modal('show');
            });

        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/adm/subtipo/"+id,
                context: this,
                success: function() {
                    linhas = $("#tabelaSubCausas>tbody>tr");
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

        function criarSubCausa() {
            subcausa = {
                subcausa: $('#subcausaid').val(),
                causa_id: $('#causa_id').val()
            };
            $.post("/api/adm/subtipo", subcausa, function(data){
                sub = JSON.parse(data);
                linha = montarLinha(sub);
                $('#tabelaSubCausas>tbody').append(linha);
            });
        }

        function salvarSubCausa() {
            causa = {
                id: $("#id").val(),
                subcausa: $("#subcausaid").val(),
                causa_id: $("#causa_id").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/adm/subtipo/" + causa.id,
                context: this,
                data: causa,
                success: function(data){
                    causa = JSON.parse(data);
                    linhas = $("#tabelaSubCausas>tbody>tr")
                    e = linhas.filter(function(i,e){
                        return(e.cells[0].textContent == causa.id);
                    });
                    if(e) {
                        e[0].cells[0].textContent = causa.id;
                        e[0].cells[1].textContent = causa.subcausa;
                        e[0].cells[2].textContent = causa.causa_id;
                    }
                    console.log("Salvou OK");
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $("#formSubCausas").submit( function (event) {
            event.preventDefault();
            if($("#id").val() != '')
                salvarSubCausa();
            else
                criarSubCausa();
            $("#dlgSubCausas").modal('hide');

        });

        $(function(){
            carregarSubCausas();
            carregarCausas();
        })

    </script>

@endsection
