
@extends('layout.app', ["current" => "login"])


@guest
@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row justify-content-center">
            <div class="card border-primary">
                <h5 class="card-title">Login</h5>
                <div class="card-body">
                    <form action="" class="form-horizontal" id="formLogin" method="post">
                        <div class="form-group">
                            <label for="usuario">Usuário:</label>
                            <input type="text" id="usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="password" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@endguest

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        function login()
        {
            lgn = {
                usuario: $('#usuario').val(),
                password: $('#password').val()
            };
            console.log(lgn);

            // $.post("/api/logar", lgn, function(data){
            //     lgn = JSON.parse(data);
            //     alert('Bem vindo ' + lgn.usuario);
            // });

            $.ajax({
                url: '/api/login/',
                type: 'POST',
                context: this,
                data: lgn,
                success: function(data){
                    alert('Bem vindo ' + lgn.usuario);
                },
                error: function(request){
                    console.log(request);
                }
            });
        }

        $("#formLogin").submit(function (event) {
            event.preventDefault();
            login();
        })




    </script>

@endsection