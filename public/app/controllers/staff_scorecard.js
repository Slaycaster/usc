var local = 'http://' + location.host;

app.controller('APIStaffScorecardController', function($scope, $http, $interval) {

	$scope.staff_targets = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(local + '/usc/public/api/staff_scorecard').
		success(function(data, status, headers, config) {

			$scope.staff_targets = data;
			console.log($scope.staff_targets);
				$scope.loading = false;
		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    
/*
    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = local + '/usc/public/api/chief_accomplishments';

        //append Unit Objective ID to the URL if the form is in edit mode

            url += "/" + id;
            console.log(document.getElementById('chief_id').value);
            $http.put(url, {
                ChiefOwnerContent: document.getElementById('id_owner').value,
                JanuaryAccomplishment: document.getElementById('id_jan').value,
                FebruaryAccomplishment: document.getElementById('id_feb').value,
                MarchAccomplishment: document.getElementById('id_mar').value,
                AprilAccomplishment: document.getElementById('id_apr').value,
                MayAccomplishment: document.getElementById('id_may').value,
                JuneAccomplishment: document.getElementById('id_jun').value,
                JulyAccomplishment: document.getElementById('id_jul').value,
                AugustAccomplishment: document.getElementById('id_aug').value,
                SeptemberAccomplishment: document.getElementById('id_sep').value,
                OctoberAccomplishment: document.getElementById('id_oct').value,
                NovemberAccomplishment: document.getElementById('id_nov').value,
                DecemberAccomplishment: document.getElementById('id_dec').value,
                ChiefInitiativeContent: document.getElementById('id_initiative').value,
                ChiefFundingEstimate: document.getElementById('id_estimate').value,
                ChiefFundingActual: document.getElementById('id_actual').value,
                ChiefMeasureID: document.getElementById('chiefmeasure_id').value,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $scope.chief_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        // 
    };
*/

    $scope.init();
});