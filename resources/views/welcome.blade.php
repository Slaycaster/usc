<!DOCTYPE html>
<html lang="en-PH">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="120">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#363636 ">
    <meta name="msapplication-navbutton-color" content="#363636 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#363636">
    <meta name="description" content="Philippine National Police Unit Scorecard">
    <meta name="keywords" content="PNP, unit scorecard, usc, pnp usc">
    <meta name="author" content="Fare Matrix">

    <title>Philippine National Police Unit Scorecard</title>

    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/stylish-portfolio.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <header id="top" class="header">
        <div class="col-md-12 text-vertical-center" id="firstScreen">
            <br /><br />
            <h1 class="welcome-stylish-title">PNP UNIT SCORECARD</h1>
            <div class="container image_big">
                <div class ="col-md-6">
                    <img class="welcome-stylish-logo-one" src="{{ asset('img/pnp_logo.png') }}">
                </div>
                <div class="col-md-6">
                    <img class="welcome-stylish-logo-two" src="{{ asset('img/pp_logo.png') }}">
                </div>
            </div>

            <div class="col-md-6 image_small">
                <div class ="col-md-6">
                    <img class="welcome-stylish-logo-one" src="{{ asset('img/pnp_logo.png') }}">
                    <img class="welcome-stylish-logo-two" src="{{ asset('img/pp_logo.png') }}">
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3">
                @if (Session::has('message2'))
                    <div class="alert alert-success">{{ Session::get('message2') }}</div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-warning">{{ Session::get('message') }}</div>
                @endif
            </div>
            
            <p class="col-md-12 welcome-stylish-objective">Create, track, and accomplish Unit tasks.</p>
            <p class="col-md-12 welcome-stylish-objective">Philippine National Police</p>
            <br>
            <div class="col-md-6 col-md-offset-3">
                <a href="#" class="btn btn-dark btn-lg welcome-style-get-started" id="btnStart">Get Started</a>
            </div>
        </div>


        <div class="col-md-12 text-vertical-center" id="secondScreen">
            <br /><br />
            <h1 class="welcome-stylish-login-title">Login to PNP Unit Scorecard</h1>
            <p class="welcome-stylish-instruction">Hello Officer! Please login using your Badge No. and Password</p>
            <div class="container welcome-stylish-container">
                <div class="row">
                    <center>

                        <div class="col-md-6 col-md-offset-3">
                           <form action="login" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="input-group container-fluid welcome-stylish-message">
                                            @if (Session::has('message'))
                                                <div class="alert alert-warning">{{ Session::get('message') }}</div>
                                            @endif
                                        </div>
                                        <!--./input-group-->

                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span> 
                                            <input type="text" name="username" placeholder="Badge No" autocomplete="off" required class="form-control welcome-stylish-badge"/>
                                        </div>
                                        <!--./input-group-->
                                    </div>
                                    <!--./form-group-->

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </span>
                                            <input type="password" name="password" placeholder="Password" autocomplete="off" required class="form-control welcome-stylish-password"/>
                                        </div>
                                        <!--./input-group-->
                                    </div>
                                    <!--./form-group-->

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-dark btn-block">Login</button>
                                    </div>
                                    <!--./form-group-->
                                </div>
                            </fieldset>
                            </form>
                                
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </header>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#secondScreen").hide();
            $("#btnStart").click(function(){
                $("#firstScreen").fadeOut('slow', function(){
                    $("#secondScreen").fadeIn();
                });
            });
        });
    </script>

</body>

</html>