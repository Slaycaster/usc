var local = 'http://localhost';

app.controller('APIUnitMeasureController', function($scope, $http) {
 
	$scope.unit_measures = [];
	$scope.loading = false;
 
	$scope.init = function() 
    {
		$scope.loading = true;
		$http.get(local + '/usc/public/api/unit_measures').
		success(function(data, status, headers, config) {
			$scope.unit_measures = data;
				$scope.loading = false;
		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };


     $scope.toggle = function(modalstate, id) 
     {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD UNIT'S MEASURE";
                break;
            case 'edit':
                $scope.form_title = "EDIT UNIT'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/unit_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_measure = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    $scope.save = function(modalstate, id) {
		$scope.loading = true;
		var url = local + '/usc/public/api/unit_measures';

		//append Unit Objective ID to the URL if the form is in edit mode
		if (modalstate === 'edit')
		{
			url += "/" + id;
			console.log(document.getElementById('unit_id').value);
			$http.put(url, {
				UnitMeasureName: $scope.unit_measure.UnitMeasureName,
				UnitMeasureType: $scope.unit_measure.UnitMeasureType,
				UnitID: document.getElementById('unit_id').value,
				UserUnitID: document.getElementById('user_unit_id').value

			}).success(function(data, status, headers, config, response) {
				console.log(response);
				$('#myModal').modal('hide');
				$scope.unit_measures = ' ';
				$scope.init();
	 			$scope.loading = false;
			});
		}
		else if (modalstate === 'add')
		{
			$http.post(url, {
				UnitMeasureName: $scope.unit_measure.UnitMeasureName,
				UnitMeasureType: $scope.unit_measure.UnitMeasureType,
				UnitID: document.getElementById('unit_id').value,
				UserUnitID: document.getElementById('user_unit_id').value

			}).success(function(data, status, headers, config, response) {
				console.log(response);
				$('#myModal').modal('hide');
				$scope.unit_measures = ' ';
				$scope.init();
	 			$scope.loading = false;
			});
		}

	};


	$scope.init();
});

