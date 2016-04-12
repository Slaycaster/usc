var local = 'http://localhost';

app.controller('APIUnitAuditTrailsController', function($scope, $http) {
 
    $scope.unit_audit_trails = [];
    $scope.loading = false;
 
    $scope.init = function() {
        $scope.loading = true;
        $http.get(local + '/usc/public/api/unit_audit_trails').
        success(function(data, status, headers, config) {
            $scope.unit_audit_trails = data;
                $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
});

