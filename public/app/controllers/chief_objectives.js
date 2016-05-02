var local = 'http://' + location.host;
 
app.controller('APIChiefObjectiveController', function($scope, $http, $interval) {
 
    $scope.chief_objectives = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/chief_objectives').
        success(function(data, status, headers, config) {
            $scope.chief_objectives = data;
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
        var url = local + '/usc/public/api/chief_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id; /*console.log(id);*/
            console.log(document.getElementById('chief_id').value);
            $http.put(url, {
                ChiefObjectiveName: $scope.chief_objective.ChiefObjectiveName,
                PerspectiveID: $scope.chief_objective.PerspectiveID,
                StaffID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                ChiefObjectiveName: $scope.chief_objective.ChiefObjectiveName,
                PerspectiveID: $scope.chief_objective.PerspectiveID,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_objective = '';
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
                $scope.form_title = "ADD CHIEF'S OBJECTIVE";
                document.getElementById('id_objective_name').value = "";
                document.getElementById('id_perspective_id').value = "";
                break;
            case 'edit':
                $scope.form_title = "EDIT CHIEF'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/chief_objectives/' + id)
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