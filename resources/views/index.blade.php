<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyMCDA-C</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff
                /*color: #636b6f;*/
                background-image: url(assets/img/fundo.jpg);
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                position: absolute; 
                left: 450px; /* posiciona a 90px para a esquerda */ 
                top: 200px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                   @auth
                        <a href="{{ url('/projects') }}">Projects</a>
                   @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif 

            <div class="content">
                <div class="title m-b-md">
                    MyMCDA-C
                </div>

                <div class="links">
                    <a href="{{ url('/projects') }}">Projects</a>
                    <a href="https://laracasts.com">Research</a>
                    <a href="https://forge.laravel.com">Account</a>
                    <a href="https://github.com/laravel/laravel">FAC</a>
                    <a href="{{ url('/privacy_notice') }}">Privacy Notice</a>
                </div>
            </div>
        </div>
    </body>
</html>
