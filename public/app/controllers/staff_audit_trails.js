var local = 'http://' + location.host;

app.controller('APIStaffAuditTrailsController', function($scope, $http, $interval) {
    $scope.staff_audit_trails = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/staff_audit_trails').
        success(function(data, status, headers, config) {
            $scope.staff_audit_trails = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $interval( function(){ $scope.init(); }, 3000);
    
});
