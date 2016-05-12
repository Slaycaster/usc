var local = 'http://' + location.host;

app.controller('APIChiefScorecardController', function($scope, $http, $interval) {

	$scope.chief_targets = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(local + '/usc/public/api/chief_scorecard').
		success(function(data, status, headers, config) {

			$scope.chief_targets = data;
			console.log($scope.chief_targets);
				$scope.loading = false;
		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.init();
});