var local = 'http://' + location.host;
 
app.controller('APIStaffObjectiveController', function($scope, $http, $interval) {
 
    $scope.staff_objectives = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/staff_objectives').
        success(function(data, status, headers, config) {
            $scope.staff_objectives = data;
                $scope.loading = false;



        $http.get(local + '/usc/public/api/perspectives').
        success(function(data, status, headers, config)
        {   
            $scope.perspective = data;
            $scope.selectedUserProfile = $scope.perspective[0];
        });

        $http.get(local + '/usc/public/api/staff/objectives/chiefobjectives').
        success(function(data, status, headers, config)
        {   
           
            $scope.chiefobjective = data;
            //$scope.chiefobjective = [{ChiefObjectiveID : 0, ChiefObjectiveName: "None/No Contributory"}];
            
            
            $scope.none = {ChiefObjectiveID : 0, ChiefObjectiveName: "None/No Contributory"};
          
            $scope.chiefobjective.unshift($scope.none);
            //$scope.chiefobjective.push(data);
            $scope.selectedChiefObjective = $scope.chiefobjective[0];


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
        var url = local + '/usc/public/api/staff_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id; /*console.log(id);*/
           
            $http.put(url, {
                StaffObjectiveName: $scope.staff_objective.StaffObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                ChiefObjectiveID: $scope.selectedChiefObjective.ChiefObjectiveID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
         
                $('#myModal').modal('hide');
                $scope.staff_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                StaffObjectiveName: $scope.staff_objective.StaffObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                ChiefObjectiveID: $scope.selectedChiefObjective.ChiefObjectiveID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
             
                $('#myModal').modal('hide');
                $scope.staff_objective = '';
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
                $scope.form_title = "ADD STAFF'S OBJECTIVE";
                document.getElementById('id_objective_name').value = "";
                break;
            case 'edit':
                $scope.form_title = "EDIT STAFF'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/staff_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.staff_objective = response;
                            $scope.selectedUserProfile = $scope.perspective[response.PerspectiveID-1];
                            console.log(response.ChiefObjectiveID);

                            
                                $scope.selectedChiefObjective = $scope.chiefobjective[response.ChiefObjectiveID];
                            
                            
                        });
                break;
            default:
                break;
        }
       
        $('#myModal').modal('show');
    };

    $scope.init();

    //$interval(function(){ $scope.init(); }, 1000);
 
});//app.controller(UnitObjectiveController)