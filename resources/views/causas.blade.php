@extends('layout.app', ["current" => "adm"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Causas</h5>
            <table class="table table-ordered table-hover" id="tabelaCausas">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Causa</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novaCausa()">Nova Causa</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgCausas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formCausas">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Causa</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="causaid" class="control-label">Causa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="causaid" placeholder="Causa">
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


        function novaCausa() {
            $('#id').val('');
            $('#causaid').val('');
            $('#dlgCausas').modal('show');
        }

        function carregarCausas() {
            $.getJSON('/api/adm/causas', function(data){
                for(i=0; i<data.length;i++){
                    linha = montarLinha(data[i]);
                    $('#tabelaCausas>tbody').append(linha);
                }
            });
        }

        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.causa + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar('+ p.id +')"> Editar </button> ' +
                '<button class="btn btn-sm btn-danger" onclick="remover('+ p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }

        function editar(id) {
            $.getJSON('/api/adm/causas/'+id, function(data){
               $('#id').val(data.id);
               $('#causaid').val(data.causa);
               $('#dlgCausas').modal('show');
            });

        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/adm/causas/"+id,
                context: this,
                success: function() {
                    linhas = $("#tabelaCausas>tbody>tr");
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

        function criarCausa() {
            causav = {
                causa: $('#causaid').val()
            };
            $.post("/api/adm/causas", causav, function(data){
                causas = JSON.parse(data);
                linha = montarLinha(causas);
                $('#tabelaCausas>tbody').append(linha);
            });
        }

        function salvarCausa() {
            causa = {
                id: $("#id").val(),
                causa: $("#causaid").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/adm/causas/" + causa.id,
                context: this,
                data: causa,
                success: function(data){
                    causa = JSON.parse(data);
                    linhas = $("#tabelaCausas>tbody>tr")
                    e = linhas.filter(function(i,e){
                        return(e.cells[0].textContent == causa.id);
                    });
                    if(e) {
                        e[0].cells[0].textContent = causa.id;
                        e[0].cells[1].textContent = causa.causa;
                    }
                    console.log("Salvou OK");
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $("#formCausas").submit( function (event) {
            event.preventDefault();
            if($("#id").val() != '')
                salvarCausa();
            else
                criarCausa();
            $("#dlgCausas").modal('hide');

        });

        $(function(){
            carregarCausas();
        })

    </script>

@endsection
