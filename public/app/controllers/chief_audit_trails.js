var local = 'http://' + location.host;
var public = '/usc/public/'; // replace this with '/' for production

app.controller('APIChiefAuditTrailsController', function($scope, $http, $interval) {
    $scope.chief_audit_trails = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + public + 'api/chief_audit_trails').
        success(function(data, status, headers, config) {
            $scope.chief_audit_trails = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $interval( function(){ $scope.init(); }, 3000);
    
});
