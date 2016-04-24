    <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3b5998 ">
    <meta name="msapplication-navbutton-color" content="#3b5998 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3b5998">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Audit Trails API</title>

    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('unit/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_audit_trails.js') }}"></script>

    <style type="text/css">
        pre{
            background-color: white;
            border: none;
        }
        .table>tbody>tr>td{
            border-top:none;
        }
    </style>

</head>
<body>
    <div ng-app="unitScorecardApp" ng-controller="APIUnitAuditTrailsController">
        <div class="container-fluid">    
            <div class="table-responsive">  
                <table class="table">
                    <tr dir-paginate='audit_trail in unit_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                        <td><pre><% audit_trail | json %></pre></td>
                    </tr>
                </table>
            </div>
           
            <center>
                <dir-pagination-controls
                   max-size="5"
                   direction-links="true"
                   boundary-links="true" >
                </dir-pagination-controls>
                <!--./dir-pagination-controls-->
            </center> 
        </div>
    </div>
</body>
</html>
  
