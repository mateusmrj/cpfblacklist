<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Blacklist MaxMilhas</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>

        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="js/jquery.mask.js"></script>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

        <!-- Sweet Alert -->
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="container text-center col-lg-6 col-sm-10 col-lg-push-3 col-sm-push-1">
                    <h1>Blacklist de CPF</h1>
                    <h3>Digite o CPF que deseja consultar:</h3>
                    <form class="form-inline" id="formCpf" action="#">
                        <div class="form-group">
                            <label for="txtCpf" class="control-label">CPF: <input type="text" name="txtCpf" id="txtCpf"
                                                                                  class="cpf form-control" required="required"/></label>
                            <span class="badge" id="badge"></span>
                        </div>
                        <div class="form-group">
                            <button name="btnVerifica" id="btnVerifica" class="btn btn-default">Verificar</button>

                        </div>
                        <pre>
                        </pre>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="container text-center col-lg-2 col-md-4 col-sm-6 col-lg-push-5 col-md-4 col-sm-push-3">
                    <button name="block" id="blockCpf" class="btn btn-md btn-danger pull-left">Bloquear</button>
                    <button name="free" id="freeCpf" class="btn btn-md btn-success pull-right">Liberar</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="container col-lg-6 col-sm-10 col-lg-push-3 col-sm-push-1">
                    <div class="alert invisible" role="alert" id="reqMessage"></div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/functions.js"></script>
    <script>
        $(document).ready(function () {

            $('#blockCpf').hide();
            $('#freeCpf').hide();
            
            $('.cpf').mask('000.000.000-00', {reverse: true});
            
            
            @if (session('mensagem'))
                swal("Ok!", "{{ session('mensagem') }}", "success");
            @endif

            @if(session('error'))
                swal({
                    title: 'Atenção!',
                    type: 'info',
                    html: '{{ session("error") }}',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false
                });
            @endif

            @if ($errors->any())
                var txt_error = "";

                @foreach ($errors->all() as $error)
                    txt_error = txt_error +"{{ $error }} <br>";
                @endforeach

                swal({
                    title: 'Atenção!',
                    type: 'info',
                    html: txt_error,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false
                });
            @endif

            
        });
    </script>
</html>