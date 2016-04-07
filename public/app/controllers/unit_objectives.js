console.log('response');
app.controller('unitObjectivesController', function($scope, $http) {
    //retrieve Unit Objectives listing from API
    $http.get("http://localhost/usc/public/api/unit_objectives")
            .success(function(response) {
                $scope.unit_objectives = response;
            });
    
    
});