<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3b5998 ">
    <meta name="msapplication-navbutton-color" content="#3b5998 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3b5998">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PNP Unit Scorecard</title>

    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/stylish-portfolio.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'> -->

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
             <br /><br />
            <div class="container">
                <div class ="col-md-12">
                    <a href="{{ url("/") }}"><img class="welcome-stylish-logo-one" src="{{ asset('img/404.png') }}"/></a> 
                </div>
            </div>
            
            <h2 class="welcome-stylish-title">Oops! Officer It seems like you're lost!</h2>
            <br />
            <p class="col-md-12 welcome-stylish-objective">404 Not Found</p>
            <!-- <div class="col-md-6 col-md-offset-3">
                <a href="{{ url("/") }}" class="btn btn-dark btn-lg welcome-style-get-started" id="btnStart">Go Home</a>
            </div> -->
            
        </div>
    </header>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

   

</body>

</html>