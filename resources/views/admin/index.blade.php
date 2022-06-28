<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="icon" type="image/png" href="{{ env('APP_URL') }}images/favicon.png"/>
    <link rel="stylesheet" href="{{ env('APP_URL') }}css/quirk.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}backend/assets/css/login.css"/>
    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/fontawesome/css/font-awesome.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>4-trace</title>
</head>
<body class="signwrapper">


<div class="sign-overlay"></div>
<div class="signpanel"></div>

<div class="panel signin">

    <div class="panel-heading text-center">
        <img src="{{ env('APP_URL') }}images/logo-4-trace.png" alt="">
        <h4 class="panel-title">Insira seus dados para acessar o sistema</h4>
    </div>
    <div class="panel-body">
        <form name="login" id="formlogin" action="{{route('admin.login.do')}}" method="post" autocomplete="off">
            <div class="ajax_response"></div>
            <div class="form-group mb10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" value=""
                           name="email" placeholder="Informe seu e-mail" required/>
                </div>
            </div>
            <div class="form-group nomargin ">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="password_check" value=""
                           placeholder="Informe sua senha"/>
                </div>
            </div>

            <div class="form-group mt10">
                <button type="submit" class="btn btn-success btn-quirk btn-block">Entrar</button>
            </div>
        </form>
        <hr class="invisible">
        <div class="form-group">

        </div>
    </div>
</div><!-- panel -->


<script src="{{ env('APP_URL') }}backend/assets/js/jquery.js"></script>
<script src="{{ env('APP_URL') }}backend/assets/js/login.js"></script>

</body>
</html>
