app.controller('APIChiefPasswordController', function($scope, $http, $interval) {
    $scope.chief_password = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/chief_audit_trails').
        success(function(data, status, headers, config) {
            $scope.chief_password = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
    
});

app.controller('APIStaffPasswordController', function($scope, $http, $interval) {
    $scope.staff_password = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/staff_audit_trails').
        success(function(data, status, headers, config) {
            $scope.staff_password = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
    
});

app.controller('APIUnitPasswordController', function($scope, $http, $interval) {
    $scope.staff_password = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/unit_audit_trails').
        success(function(data, status, headers, config) {
            $scope.staff_password = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
    
});


app.controller('APISecondaryUnitPasswordController', function($scope, $http, $interval) {
    $scope.secondary_unit_password = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/secondary_unit_audit_trails').
        success(function(data, status, headers, config) {
            $scope.secondary_unit_password = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
    
});


app.controller('APITertiaryUnitPasswordController', function($scope, $http, $interval) {
    $scope.secondary_unit_password = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/tertiary_unit_audit_trails').
        success(function(data, status, headers, config) {
            $scope.secondary_unit_password = data;
            $scope.loading = false;
        }); 
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
    
});
