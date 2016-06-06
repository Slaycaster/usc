app.controller('APIUnitObjectiveController', function($scope, $http, $interval) {
 
    $scope.unit_objectives = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/unit_objectives').
        success(function(data, status, headers, config) {
        $scope.unit_objectives = data;
        $scope.loading = false;
        $http.get(public + 'api/perspectives').
            success(function(data, status, headers, config)
            {   
                $scope.perspective = data;
                $scope.selectedUserProfile = $scope.perspective[0];
            });

            $http.get(public + 'api/unit/objectives/staffobjectives').
                success(function(data, status, headers, config)
                {   
                       
                    $scope.staffobjective = data;
                    //$scope.chiefobjective = [{ChiefObjectiveID : 0, ChiefObjectiveName: "None/No Contributory"}];
                        
                        
                    $scope.none = {StaffObjectiveID : 0, StaffObjectiveName: "None/No Contributory"};
                      
                    $scope.staffobjective.unshift($scope.none);
                        //$scope.chiefobjective.push(data);
                    $scope.selectedStaffObjective = $scope.staffobjective[0];
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
        var url = public + 'api/unit_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id; /*console.log(id);*/
            console.log(document.getElementById('unit_id').value);
            $http.put(url, {
                UnitObjectiveName: $scope.unit_objective.UnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                StaffObjectiveID: $scope.selectedStaffObjective.StaffObjectiveID,
                UnitID: document.getElementById('unit_id').value,
                UserUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.unit_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                UnitObjectiveName: $scope.unit_objective.UnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                StaffObjectiveID: $scope.selectedStaffObjective.StaffObjectiveID,
                UnitID: document.getElementById('unit_id').value,
                UserUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.unit_objective = '';
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
                $http.get(public + 'api/unit_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_objective = response;

                             $scope.selectedUserProfile = $scope.perspective[response.PerspectiveID-1];
                            console.log(response.ChiefObjectiveID);

                            
                                $scope.selectedStaffObjective = $scope.staffobjective[response.StaffObjectiveID];
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