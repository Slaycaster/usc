var local = 'http://' + location.host;
var public = '/usc/public/'; // replace this with '/' for production

app.controller('APIChiefAuditTrailsDashController', function($scope, $http, $interval) {
    $scope.chief_audit_trails_dash = [];
    $scope.loading = true;

    $scope.init = function() {
        $scope.loading = false;
        $http.get(local + public + 'api/chief_dashboard').
        success(function(data, status, headers, config) {
            nowTime = (new Date()).getTime();
            $scope.chief_audit_trails_dash = data;
                $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };
    $interval( function(){ $scope.init(); }, 3000);
    
});
