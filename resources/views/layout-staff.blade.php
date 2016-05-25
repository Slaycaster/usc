<!DOCTYPE html>
<html lang="en-PH">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#782225 ">
    <meta name="msapplication-navbutton-color" content="#782225 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#782225">
    <meta name="description" content="Philippine National Police Unit Scorecard">
    <meta name="keywords" content="PNP, unit scorecard, usc, pnp usc">
    <meta name="author" content="Fare Matrix">

    <title>Staff Dashboard - Philippine National Police Unit Scorecard</title>

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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/staff.css') }}">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('unit/bower_components/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('unit/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('unit/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('unit/dist/js/sb-admin-2.js') }}"></script>

    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
     <script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layout_staff-body">
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


                <img class="img-responsive dashboard-custom-pictureabb" 
                     src="{{ asset('uploads/userpictures/unit/cropped/'.''.$staff_user->UserStaffPicturePath.'') }}"
                     style="width:25px; height:25px; margin-left: 1056px; margin-top: 14px">&nbsp;
            </div>
            <div class="layout-custom-username"> 
                <img class="img-responsive dashboard-custom-pictureabb" 
                                src="{{ asset('uploads/userpictures/unit/cropped/'.''.$staff_user->UserStaffPicturePath.'') }}"
                                style="width:20px; height:20px;">&nbsp;
                    Welcome 
                    {{ $staff_user->rank->RankCode }} {{ $staff_user->UserStaffFirstName }} {{ $staff_user->UserStaffLastName }}!
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right layout-custom-navbrand">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle layout-custom-navbaruser" data-toggle="dropdown">

                        Welcome      
                    {{ $staff_user->rank->RankCode }} {{ $staff_user->UserStaffFirstName }} {{ $staff_user->UserStaffLastName }}! &nbsp; 
                    
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('staff/changeuserpicture') }}"><span class="fa fa-file-picture-o fa-fw"></span>&nbsp;
                                Change Profile Picture</a>
                        </li>
                        <li>
                            <a href="{{ url('staff/changepassword') }}"><span class="fa fa-lock fa-fw"></span>&nbsp;
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
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ url('staff/dashboard') }}">
                                <i class="fa fa-dashboard fa-fw"></i> 
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('staff/scorecard') }}">
                                <i class="fa fa-table fa-fw"></i> 
                                {{ $staff_user->staff->StaffAbbreviation }} Scorecard
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> 
                                Set Activities<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('staff/objectives') }}">Set Staff Objectives</a>
                                </li>
                                <li>
                                    <a href="{{ url('staff/measures') }}">Set Staff Measures</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('staff/targets') }}"><i class="fa fa-table fa-fw"></i> Set Measure Targets</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Queries/Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('staff/reports') }}">Staff Scorecard Report</a>
                                </li>
                                <li>
                                    <a href="#">Staff Scorecard Analysis Report</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Utilities<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('staff/changestaffpicture') }}">Change Staff Picture</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="layout-custom-usernavoptions">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <img class="img-responsive dashboard-custom-pictureabb" 
                                src="{{ asset('uploads/userpictures/unit/cropped/'.''.$staff_user->UserStaffPicturePath.'') }}"
                                style="width:20px; height:20px;"> {{ $staff_user->rank->RankCode }} {{ $staff_user->UserStaffFirstName }} {{ $staff_user->UserStaffLastName }} <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('staff/changeuserpicture') }}"><span class="fa fa-file-picture-o fa-fw"></span>&nbsp;
                                        Change Profile Picture</a>
                                </li>
                                <li>
                                    <a href="{{ url('staff/changepassword') }}"><span class="fa fa-lock fa-fw"></span>&nbsp;
                                        Change User Password</a>
                                </li>
                                <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="the-blur"></div>

        <div id="page-wrapper" class="unit-page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

</body>

</html>
