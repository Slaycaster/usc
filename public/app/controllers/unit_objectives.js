// console.log('response');
// app.controller('unitObjectivesController', function($scope, $http) {
//     //retrieve Unit Objectives listing from API
//     $http.get("http://localhost/usc/public/api/unit_objectives")
//             .success(function(response) {
//                 $scope.unit_objectives = response;
//             });
    
    
// });

 
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
    };
 
    $scope.save = function(modalstate, id) {
        $scope.loading = true;
        var url = 'http://localhost/usc/public/api/unit_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(id);
            $http.put(url, {
                UnitObjectiveName: $scope.unit_objective.UnitObjectiveName,
                PerspectiveID: $scope.unit_objective.PerspectiveID,
                UnitID: document.getElementById('unit_id').value,
                UserUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
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
                $('#myModal').modal('hide');
                $scope.unit_objective = ' ';
                $scope.init();
                $scope.loading = false;
            });
        }

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
                            $scope.unit_objective = response;
                        });
                break;
            default:
                break;
        }
        $('#myModal').modal('show');
    }

    $scope.init();
 
});//app.controller(UnitObjectiveController)