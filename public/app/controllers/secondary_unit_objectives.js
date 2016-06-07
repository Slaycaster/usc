app.controller('APISecondaryUnitObjectiveController', function($scope, $http, $interval) {
 
    $scope.secondary_unit_objectives = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/secondary_unit_objectives').
        success(function(data, status, headers, config) {
        $scope.secondary_unit_objectives = data;
        $scope.loading = false;
        $http.get(public + 'api/perspectives').
            success(function(data, status, headers, config)
            {   
                $scope.perspective = data;
                $scope.selectedUserProfile = $scope.perspective[0];
            });

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
        var url = public + 'api/secondary_unit_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id; /*console.log(id);*/
            console.log(document.getElementById('unit_id').value);
            $http.put(url, {
                SecondaryUnitObjectiveName: $scope.unit_objective.SecondaryUnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                SecondaryUnitID: document.getElementById('unit_id').value,
                UserSecondaryUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.secondary_unit_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                SecondaryUnitObjectiveName: $scope.unit_objective.SecondaryUnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                SecondaryUnitID: document.getElementById('unit_id').value,
                UserSecondaryUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.secondary_unit_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
    };
 
    $scope.toggle = function(modalstate, id) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD UNIT'S OBJECTIVE";
                document.getElementById('id_objective_name').value = "";
                
                break;
            case 'edit':
                $scope.form_title = "EDIT UNIT'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(public + 'api/secondary_unit_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_objective = response;

                            $scope.selectedUserProfile = $scope.perspective[response.PerspectiveID-1];
                            // $scope.selectedStaffObjective = $scope.staffobjective[response.StaffObjectiveID];
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    $scope.init();

    //$interval(function(){ $scope.init(); }, 1000);
 
});//app.controller(UnitObjectiveController)