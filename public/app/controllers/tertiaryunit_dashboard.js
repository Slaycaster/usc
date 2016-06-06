app.controller('APITertiaryUnitAuditTrailsDashController', function($scope, $http, $interval) {
    $scope.unit_audit_trails_dash = [];
    $scope.loading = true;

    $scope.init = function() {
        $scope.loading = false;
        $http.get(public + 'api/tertiary_unit_dashboard').
        success(function(data, status, headers, config) {
            nowTime = (new Date()).getTime();
            // timeDifference = nowTime - data.audit_trail_dash.updated_at;
            // console.log(timeDifference);
            $scope.unit_audit_trails_dash = data;
                $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };
    $interval( function(){ $scope.init(); }, 3000);
    
});
