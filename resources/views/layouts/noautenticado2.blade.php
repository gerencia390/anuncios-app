<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - {{env('APP_NAME')}}</title>
    {{-- HOJAS DE ESTILO --}}
    <link rel="shortcut icon" href="{{secure_url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{secure_url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{secure_url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{secure_url('css/ext.styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{secure_url('css/font-awesome.min.css')}}">
    <script src="{{secure_url('js/jquery36.min.js')}}"></script>
    <script src="{{secure_url('js/popper.min.js')}}"></script>
    <script src="{{secure_url('js/bootstrap.min.js')}}"></script>

    <style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #222;
}

/* Contenedor base */
#portrait-wrapper {
    width: 100vw;
    height: 100vh;
    position: relative;
    overflow: hidden;
}

/* Contenido rotado */
#portrait-content {
    width: 100vh;   /* OJO: se intercambian */
    height: 100vw;

    position: absolute;
    top: 50%;
    left: 50%;

    transform:
        translate(-50%, -50%)
        rotate(270deg);

    transform-origin: center center;
}

    </style>
</head>
<body>
    {{-- CONTENIDO PRINCIPAL (INICIO) --}}
    <div id="portrait-wrapper">
        <div id="portrait-content">
        @yield('contenido')        
        </div>
    </div>
    {{-- CONTENIDO PRINCIPAL (FIN)--}}
    <script>
        $(function(){
            $('.login-box').hide();
            $('.login-box').fadeIn(2000);
        });
    </script>
</body>
</html>