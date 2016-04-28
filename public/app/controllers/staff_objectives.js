var local = 'http://localhost';
 
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
            console.log(document.getElementById('staff_id').value);
            $http.put(url, {
                StaffObjectiveName: $scope.staff_objective.StaffObjectiveName,
                PerspectiveID: $scope.staff_objective.PerspectiveID,
                ChiefObjectiveID: $scope.staff_objective.ChiefObjectiveID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
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
                PerspectiveID: $scope.staff_objective.PerspectiveID,
                ChiefObjectiveID: $scope.staff_objective.ChiefObjectiveID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
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
                document.getElementById('id_perspective_id').value = "";
                break;
            case 'edit':
                $scope.form_title = "EDIT STAFF'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/staff_objectives/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.staff_objective = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    $interval(function(){ $scope.init(); }, 5000);
 
});//app.controller(UnitObjectiveController)