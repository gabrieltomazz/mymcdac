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
            .img-background{
                /*background-color: #fff
                /*color: #636b6f;*/
                background-image: url(assets/img/fundo.jpg) ;
                background-size: cover;
                background-repeat: no-repeat;
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
                padding-bottom: 10%; 
                left: 450px; /* posiciona a 90px para a esquerda */ 
                top: 200px;
            }

            .title {
                font-size: 100px;   
             

            }

            .links{
                text-align: center;
                padding-top: 30px;


            }

            .links > a {
                color: #000;
                padding: 0 25px;
                font-size: 14px;
                font-weight: bold;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                margin-top: 15px;
                background: rgba(0.9,0.9,0.9,0.1);
                border-radius: 15px;

                
            }

            .links > a:hover {
                color: #555;
        
            }

            .link{
                text-align: center;


            }

            .link > a {
                color: #000;
                padding: 0 25px;
                font-size: 14px;
                font-weight: bold;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                margin-top: 15px;
                
            }

            .link > a:hover {
                color: #fff;
        
            }

            .m-b-md {
                margin-bottom: 30px;
                
            }
        </style>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
            /SCRIPT SCROLL SUAVE PARA NAVBAR/
            jQuery(document).ready(function($) {
             $(".scroll_suave").click(function(event){
              event.preventDefault();
              $('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
             });
            });
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height img-background">
            @if (Route::has('login'))
                <div class="top-right link" style="position: fixed;">
                   @auth
                        <a href="{{ url('/projects') }}"> Projects</a>
                   @else
                        <a href="{{ route('login') }}"> Login  </a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>

                
            @endif 

            <div class="content" style="margin: 0 auto">
                <div class="title m-b-md" style="text-align: center;">
                    MyMCDA-C
                </div>

                <div class="links">
                    <a href="{{ url('/projects') }}">Projects</a>
                    <a href="#outro_conteudo" class="scroll_suave">Research</a>
                    <a href="#conteudo3" class="scroll_suave">Account</a>
                    <a href="https://github.com/laravel/laravel">FAC</a>
                    <a href="{{ url('/privacy_notice') }}">Privacy Notice</a>
                </div>
            </div>
            
        </div>
        
        <div id="outro_conteudo" >
            <h1>Outro conteudo</h1>
            <div class="container" >
                <section class = "content">
                    <h2>Política de privacidade para <a href='http://mymcdac.herokuapp.com/'>MyMCDA-C</a></h2>
                    <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p><p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o MyMCDA-C.</p><p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o MyMCDA-C serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).</p><p>A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.</p><p>O uso do MyMCDA-C pressupõe a aceitação deste Acordo de privacidade. A equipa do MyMCDA-C reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.</p><h2>Os anúncios</h2><p>Tal como outros websites, coletamos e utilizamos informação contida nos anúncios. A informação contida nos anúncios, inclui o seu endereço IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o Internet Explorer ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso website.</p><h2>Os Cookies e Web Beacons</h2><p>Utilizamos cookies para armazenar informação, tais como as suas preferências pessoas quando visita o nosso website. Isto poderá incluir um simples popup, ou uma ligação em vários serviços que providenciamos, tais como fóruns.</p><p>Em adição também utilizamos publicidade de terceiros no nosso website para suportar os custos de manutenção. Alguns destes publicitários, poderão utilizar tecnologias como os cookies e/ou web beacons quando publicitam no nosso website, o que fará com que esses publicitários (como o Google através do Google AdSense) também recebam a sua informação pessoal, como o endereço IP, o seu ISP, o seu browser, etc. Esta função é geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culinária regularmente, por ex.).</p><p>Você detém o poder de desligar os seus cookies, nas opções do seu browser, ou efetuando alterações nas ferramentas de programas Anti-Virus, como o Norton Internet Security. No entanto, isso poderá alterar a forma como interage com o nosso website, ou outros websites. Isso poderá afetar ou não permitir que faça logins em programas, sites ou fóruns da nossa e de outras redes.</p><h2>Ligações a Sites de terceiros</h2><p>O MyMCDA-C possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a politica de privacidade do mesmo.</p><p>Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
                </section>
            </div>
        </div>

        <div id="conteudo3" >
            <h1>Outro conteudo</h1>
            <div class="container" >
                <section class = "content">
                    <h2>Política de privacidade para <a href='http://mymcdac.herokuapp.com/'>MyMCDA-C</a></h2>
                    <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p><p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o MyMCDA-C.</p><p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o MyMCDA-C serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).</p><p>A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.</p><p>O uso do MyMCDA-C pressupõe a aceitação deste Acordo de privacidade. A equipa do MyMCDA-C reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.</p><h2>Os anúncios</h2><p>Tal como outros websites, coletamos e utilizamos informação contida nos anúncios. A informação contida nos anúncios, inclui o seu endereço IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o Internet Explorer ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso website.</p><h2>Os Cookies e Web Beacons</h2><p>Utilizamos cookies para armazenar informação, tais como as suas preferências pessoas quando visita o nosso website. Isto poderá incluir um simples popup, ou uma ligação em vários serviços que providenciamos, tais como fóruns.</p><p>Em adição também utilizamos publicidade de terceiros no nosso website para suportar os custos de manutenção. Alguns destes publicitários, poderão utilizar tecnologias como os cookies e/ou web beacons quando publicitam no nosso website, o que fará com que esses publicitários (como o Google através do Google AdSense) também recebam a sua informação pessoal, como o endereço IP, o seu ISP, o seu browser, etc. Esta função é geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culinária regularmente, por ex.).</p><p>Você detém o poder de desligar os seus cookies, nas opções do seu browser, ou efetuando alterações nas ferramentas de programas Anti-Virus, como o Norton Internet Security. No entanto, isso poderá alterar a forma como interage com o nosso website, ou outros websites. Isso poderá afetar ou não permitir que faça logins em programas, sites ou fóruns da nossa e de outras redes.</p><h2>Ligações a Sites de terceiros</h2><p>O MyMCDA-C possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a politica de privacidade do mesmo.</p><p>Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
                </section>
            </div>
        </div>

    </body>
</html>
