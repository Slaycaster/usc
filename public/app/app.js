var app = angular.module('unitObjectiveApp', ['angularUtils.directives.dirPagination'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
 
app.controller('unitObjectiveController', function($scope, $http) {
 
	$scope.unit_objectives = [];
	$scope.loading = false;
 
	$scope.init = function() {
		$scope.loading = true;
		$http.get('http://localhost/usc/public/api/unit_objectives').
		success(function(data, status, headers, config) {
			$scope.unit_objectives = data;
				$scope.loading = false;
		});
	}
 
	$scope.save = function(modalstate, id) {
		$scope.loading = true;
		var url = 'http://localhost/usc/public/api/unit_objectives';

		//append Unit Objective ID to the URL if the form is in edit mode
		if (modalstate === 'edit')
		{
			url += "/" + id;
			console.log(document.getElementById('unit_id').value);
			$http.put(url, {
				UnitObjectiveName: $scope.unit_objective.UnitObjectiveName,
				PerspectiveID: $scope.unit_objective.PerspectiveID,
				UnitID: document.getElementById('unit_id').value,
				UserUnitID: document.getElementById('user_unit_id').value

			}).success(function(data, status, headers, config, response) {
				console.log(response);
				$('#myModal').modal('hide');
				$scope.unit_objective = ' ';
				$scope.init();
	 			$scope.loading = false;
			});
		}
		else if (modalstate === 'add')
		{
			$http.post(url, {
				UnitObjectiveName: $scope.unit_objective.UnitObjectiveName,
				PerspectiveID: $scope.unit_objective.PerspectiveID,
				UnitID: document.getElementById('unit_id').value,
				UserUnitID: document.getElementById('user_unit_id').value

			}).success(function(data, status, headers, config, response) {
				console.log(response);
				$('#myModal').modal('hide');
				$scope.unit_objective = ' ';
				$scope.init();
	 			$scope.loading = false;
			});
		}

	};
 
	$scope.updateUnitObjective = function(unit_objective) {
		$scope.loading = true;
 
		$http.put('http://localhost/usc/public/api/unit_objectives/' + unit_objective.id, {
			UnitObjectiveName: unit_objective.UnitObjectiveName,
			PerspectiveID: unit_objective.PerspectiveID,
			UnitID: unit_objective.UnitID,
			UserUnitID: unit_objective.UserUnitID
		}).success(function(data, status, headers, config) {
			unit_objective = data;
				$scope.loading = false;
 			$modalInstance.dismiss('myModal');
		});;
	};
 
	$scope.deleteUnitObjective = function(index) {
		$scope.loading = true;
 
		var unit_objective = $scope.unit_objectives[index];
 
		$http.delete('http://localhost/usc/public/api/unit_objectives/' + unit_objective.id)
			.success(function() {
				$scope.unit_objectives.splice(index, 1);
					$scope.loading = false;
 
			});;
	};
 
 	$scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD UNIT'S OBJECTIVE";
                break;
            case 'edit':
                $scope.form_title = "EDIT UNIT'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get('http://localhost/usc/public/api/unit_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_objective = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }

	$scope.init();
 
});//app.controller(UnitObjectiveController)