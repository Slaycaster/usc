var local = 'http://' + location.host;

app.controller('APIChiefMeasureController', function($scope, $http, $interval) {

	$scope.chief_measures = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(local + '/usc/public/api/chief_measures').
		success(function(data, status, headers, config) {
			$scope.chief_measures = data;
				$scope.loading = false;
		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = local + '/usc/public/api/chief_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('chief_id').value);
            $http.put(url, {
                ChiefMeasureName: $scope.chief_measure.ChiefMeasureName,
                ChiefMeasureType: $scope.chief_measure.ChiefMeasureType,
                ChiefMeasureFormula: $scope.chief_measure.ChiefMeasureFormula,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_measures = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                ChiefMeasureName: $scope.chief_measure.ChiefMeasureName,
                ChiefMeasureType: $scope.chief_measure.ChiefMeasureType,
                ChiefMeasureFormula: $scope.chief_measure.ChiefMeasureFormula,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_measures = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        // 
    };

    $scope.toggle = function(modalstate, id) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD CHIEF'S MEASURE";
                document.getElementById('id_measure_name').value = "";
                document.getElementById('id_measure_type').checked = false;
                document.getElementById('id_measure_formula').value = "Summation";
                break;
            case 'edit':
                $scope.form_title = "EDIT CHIEF'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/chief_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.chief_measure = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    
	$interval( function(){ $scope.init(); }, 1000);
});

