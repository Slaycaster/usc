var local = 'http://' + location.host;
var public = '/usc/public/'; // replace this with '/' for production
 
app.controller('APITertiaryUnitObjectiveController', function($scope, $http, $interval) {
 
    $scope.tertiary_unit_objectives = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + public + 'api/tertiary_unit_objectives').
        success(function(data, status, headers, config) {
        $scope.tertiary_unit_objectives = data;
        $scope.loading = false;
        $http.get(local + public + 'api/perspectives').
            success(function(data, status, headers, config)
            {   
                $scope.perspective = data;
                $scope.selectedUserProfile = $scope.perspective[0];
            });

            $http.get(local + public + 'api/tertiary_unit/tertiary_unit_objectives/secondary_unit_objectives').
                success(function(data, status, headers, config)
                {   
                       
                    $scope.secondary_unit_objective = data;
                    //$scope.chiefobjective = [{ChiefObjectiveID : 0, ChiefObjectiveName: "None/No Contributory"}];
                        
                        
                    $scope.none = {SecondaryUnitObjectiveID : 0, SecondaryUnitObjectiveName: "None/No Contributory"};
                      
                    $scope.secondary_unit_objective.unshift($scope.none);
                        //$scope.chiefobjective.push(data);
                    $scope.selectedSecondaryUnitObjective = $scope.secondary_unit_objective[0];
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
        var url = local + public + 'api/tertiary_unit_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id; /*console.log(id);*/
            console.log(document.getElementById('tertiary_unit_id').value);
            $http.put(url, {
                TertiaryUnitObjectiveName: $scope.tertiary_unit_objective.TertiaryUnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                SecondaryUnitObjectiveID: $scope.selectedSecondaryUnitObjective.SecondaryUnitObjectiveID,
                TertiaryUnitID: document.getElementById('tertiary_unit_id').value,
                UserTertiaryUnitID: document.getElementById('user_tertiary_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.tertiary_unit_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                TertiaryUnitObjectiveName: $scope.tertiary_unit_objective.TertiaryUnitObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                SecondaryUnitObjectiveID: $scope.selectedSecondaryUnitObjective.SecondaryUnitObjectiveID,
                TertiaryUnitID: document.getElementById('tertiary_unit_id').value,
                UserTertiaryUnitID: document.getElementById('user_tertiary_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.tertiary_unit_objective = '';
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
                $scope.form_title = "ADD TERTIARY UNIT'S OBJECTIVE";
                document.getElementById('id_objective_name').value = "";
                
                break;
            case 'edit':
                $scope.form_title = "EDIT TERTIARY UNIT'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(local + public + 'api/tertiary_unit_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.tertiary_unit_objective = response;

                            $scope.selectedUserProfile = $scope.perspective[response.PerspectiveID-1];
                            console.log(response.TertiaryUnitObjectiveID);

                            
                            $scope.selectedSecondaryUnitObjective = $scope.secondary_unit_objective[response.SecondaryUnitObjectiveID];
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