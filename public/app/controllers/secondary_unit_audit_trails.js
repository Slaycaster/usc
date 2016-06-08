app.controller('APISecondaryUnitAuditTrailsController', function($scope, $http, $interval) {
    $scope.secondary_unit_audit_trails = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/secondary_unit_audit_trails').
        success(function(data, status, headers, config) {
            $scope.secondary_unit_audit_trails = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $interval( function(){ $scope.init(); }, 3000);
    
});
