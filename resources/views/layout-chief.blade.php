<!DOCTYPE html>
<html lang="en-PH">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#363636 ">
    <meta name="msapplication-navbutton-color" content="#363636 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#363636">
    <meta name="description" content="Philippine National Police Unit Scorecard">
    <meta name="keywords" content="PNP, unit scorecard, usc, pnp usc">
    <meta name="author" content="Fare Matrix">

    <title>Chief Dashboard - Philippine National Police Unit Scorecard</title>

    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('unit/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('unit/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('unit/dist/css/timeline.css') }}" rel="stylesheet">

    <!-- SB Admin Custom CSS -->
    <link href="{{ asset('unit/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Slaycaster Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-all.css') }}">

    <!-- Yujin Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chief.css') }}">

     <!-- datetimepicker-->
    <link href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    
     <!-- Morris Charts CSS -->
    <link href="{{ asset('unit/bower_components/morrisjs/morris.css') }}" rel="stylesheet">

    

    <!-- Custom Fonts -->
    <link href="{{ asset('unit/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href='https://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'> -->
    
    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('unit/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('unit/dist/js/sb-admin-2.js') }}"></script>

    <!-- Datetimepicker-->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
     <script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

     <script src="{{ asset('js/servertime.js') }}"></script>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layout_chief-body">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="layout-title-navbar navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand layout-custom-pnpname" href="{{ url('/') }}">
                    Philippine National Police Unit Scorecard
                </a>
                <a class="navbar-brand layout-custom-pnpabb" href="{{ url('/') }}">
                    PNP Unit Scorecard
                </a>

                
            </div>
            <div class="layout-custom-username">
                <span>    
                            <img class="img-responsive dashboard-custom-pictureabb" 
                            src="{{ asset('uploads/userpictures/unit/cropped/'.''.$chief_user->UserChiefPicturePath.'') }}"
                            style="width:20px; height:20px; margin-top:-5px; margin-bottom:-2px;">
                    </span>&nbsp;
                    Welcome 
                    {{ $chief_user->rank->RankCode }} 
                    {{ $chief_user->UserChiefFirstName }} 
                    {{ $chief_user->UserChiefLastName }}!
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right layout-custom-navbrand">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle layout-custom-navbaruser" data-toggle="dropdown">
                        <span class="pull-left"><img class="img-responsive dashboard-custom-pictureabb" 
                            src="{{ asset('uploads/userpictures/unit/cropped/'.''.$chief_user->UserChiefPicturePath.'') }}"
                            style="width:30px; height:30px; margin-top:-5px;">
                        </span>&nbsp;
                            Welcome 
                            {{ $chief_user->rank->RankCode }} 
                            {{ $chief_user->UserChiefFirstName }} 
                            {{ $chief_user->UserChiefLastName }}! &nbsp; 
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('chief/changeuserpicture') }}"><span class="fa fa-file-picture-o fa-fw"></span>&nbsp;
                                Change Profile Picture</a>
                        </li>

                        <li>
                            <a href="{{ url('chief/changepassword') }}"><span class="fa fa-lock fa-fw"></span>&nbsp;
                                Change User Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> 
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
            
        <nav class="layout-title-navbar navbar navbar-default side-nav" role="navigation">
            <div class="navbar-default sidebar" role="navigation" id="sidebarinfo" style="display:none;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div>
                                <div id="pst"></div>
                                <div id="clockbox"></div>
                                <div id="datebox"></div>
                                <div style="margin-top:1em;"></div>

                            </div>
                            <div><hr width="100%" color="white"></div>
                        </li>
                        <!-- <li class="standard" style="border:1px green solid;">
                            <iframe id="blockrandom" name="Philippine Standard Time" src="http://oras.pagasa.dost.gov.ph/widget.shtml" width="100%" height="95" scrolling="no" frameborder="0" class="wrapper">
                            No Iframes</iframe>
                        </li> -->
                        <li>
                            <a href="{{ url('chief/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>    Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('chief/scorecard') }}"><i class="fa fa-table fa-fw"></i> 
                                {{ $chief_user->chief->ChiefAbbreviation }} Scorecard
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> 
                                Set Activities<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('chief/objectives') }}">
                                        Set Chief Objectives
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('chief/measures') }}">
                                        Set Chief Measures
                                    </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>

                            <a href="{{ url('chief/targets') }}"><i class="fa fa-table fa-fw"></i> 
                                Set Measure Targets
                            </a>

                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> 
                                Queries/Reports<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('chief/reports') }}">
                                        Chief Scorecard Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('chief/analysis_reports') }}">
                                        Chief Scorecard Analysis Report
                                    </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Utilities<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('chief/changechiefpicture') }}">Change Chief Picture</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="layout-custom-usernavoptions">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="pull-left"><img class="img-responsive dashboard-custom-pictureabb" 
                                    src="{{ asset('uploads/userpictures/unit/cropped/'.''.$chief_user->UserChiefPicturePath.'') }}"
                                    style="width:15px; height:15px; margin-top:-5px; margin-bottom:-3px;">
                                </span>&nbsp;  {{ $chief_user->rank->RankCode }} {{ $chief_user->UserUnitChiefName }} {{ $chief_user->UserChiefLastName }} <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('chief/changeuserpicture') }}"><span class="fa fa-file-picture-o fa-fw"></span>&nbsp;
                                        Change Profile Picture</a>
                                </li>

                                <li>
                                    <a href="{{ url('chief/changepassword') }}"><span class="fa fa-lock fa-fw"></span>&nbsp;
                                        Change User Password</a>
                                </li>
                                <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            
                        </li>
                    	-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="the-blur"></div>

        <div id="page-wrapper" class="chief-page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="{{ asset('js/sidebardata.js') }}"></script>

</body>

</html>
