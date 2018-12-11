@extends('layout.app', ["current" => "adm"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Prioridades</h5>
            <table class="table table-ordered table-hover" id="tabelaPrioridade">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Prioridade</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novaPrioridade()">Nova Prioridade</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgPrioridade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formPrioridade">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Prioridade</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="prioridade" class="control-label">Prioridade</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="prioridade" placeholder="Prioridade">
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


    function novaPrioridade() {
        $('#id').val('');
        $('#prioridade').val('');
        $('#dlgPrioridade').modal('show');
    }

    function carregarPrioridades() {
        $.getJSON('/api/adm/prioridades', function(data){
            for(i=0; i<data.length;i++){
                linha = montarLinha(data[i]);
                $('#tabelaPrioridade>tbody').append(linha);
            }
        });
    }

    function montarLinha(p){
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.prioridade + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" onclick="editar('+ p.id +')"> Editar </button> ' +
            '<button class="btn btn-sm btn-danger" onclick="remover('+ p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function editar(id) {
        $.getJSON('/api/adm/prioridades/'+id, function(data){
            console.log(data);
            $('#id').val(data.id);
            $('#prioridade').val(data.prioridade);
            $('#dlgPrioridade').modal('show');
        });

    }

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/adm/prioridades/"+id,
            context: this,
            success: function() {
                linhas = $("#tabelaPrioridade>tbody>tr");
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

    function criarPrioridade() {
        prioridadev = {
            prioridade: $('#prioridade').val()
        };
        $.post("/api/adm/prioridades", prioridadev, function(data){
            prioridades = JSON.parse(data);
            linha = montarLinha(prioridades);
            $('#tabelaPrioridade>tbody').append(linha);
        });
    }

    function salvarPrioridade() {
        prior = {
            id: $("#id").val(),
            prioridade: $("#prioridade").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/adm/prioridades/" + prior.id,
            context: this,
            data: prior,
            success: function(data){
                prior = JSON.parse(data);
                linhas = $("#tabelaPrioridade>tbody>tr")
                e = linhas.filter(function(i,e){
                    return(e.cells[0].textContent == prior.id);
                });
                if(e) {
                    e[0].cells[0].textContent = prior.id;
                    e[0].cells[1].textContent = prior.prioridade;
                }
                console.log("Salvou OK");
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $("#formPrioridade").submit( function (event) {
        event.preventDefault();
        if($("#id").val() != '')
            salvarPrioridade();
        else
            criarPrioridade();
        $("#dlgPrioridade").modal('hide');

    });

    $(function(){
        carregarPrioridades();
    })

</script>

@endsection