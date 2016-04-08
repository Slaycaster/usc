<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PNP Unit Scorecard</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/stylish-portfolio.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!--
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); >PNP Unit Scorecard</a>
            </li>
            <li>
                <a href="#top" onclick = $("#menu-close").click(); >Login</a>
            </li>
        </ul>
    </nav>
     Navigation -->

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center" id="firstScreen">
            <h1>PNP Unit Scorecard</h1>
            <div>
                <div class ="col-md-6">
                    <img src="{{ asset('img/pnp_logo.png') }}" style="height:300px;">
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('img/pp_logo.png') }}" style="height:300px;">
                </div>
            </div>
            @if (Session::has('message2'))
                <div class="alert alert-success">{{ Session::get('message2') }}</div>
            @endif
            @if (Session::has('message'))
                <div class="alert alert-warning">{{ Session::get('message') }}</div>
            @endif
            <h3>Create, and accomplish Unit tasks.</h3>
            <br>
            <a href="#" class="btn btn-dark btn-lg welcome-style-get-started" id="btnStart">Get Started</a>
        </div>
        <div class="text-vertical-center" id="secondScreen">
            <h1 class="">Login to PNP Unit Scorecard</h1>
            <p class="welcome-stylish-instruction">Hello Officer! Please login using your Badge No. and Password</p>
            <div class="container welcome-stylish-container">
                <div class="row">
                    <center>
                        <div class="col-md-6 col-md-offset-3">
                           <form action="unit/login" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="input-group">
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
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    </script>

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