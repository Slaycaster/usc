var local = 'http://' + location.host;
 
app.controller('APIChiefObjectiveController', function($scope, $http, $interval) {
    
    $scope.chief_objectives = [];
    $scope.loading = true;
    $scope.info = false;
    $scope.perspective = [];
    $scope.feed = {};
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/chief_objectives').
        success(function(data, status, headers, config) {
            $scope.chief_objectives = data;
            $scope.loading = false;
            $http.get(local + '/usc/public/api/perspectives').
            success(function(data, status, headers, config){   
                $scope.perspective = data;
                $scope.selectedUserProfile = $scope.perspective[0];
            });
        });
    };

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };
 
    $scope.save = function(modalstate, id) {
        $scope.loading = true;
        var url = local + '/usc/public/api/chief_objectives';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id; 
            $http.put(url, {
                ChiefObjectiveName: $scope.chief_objective.ChiefObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                $('#myModal').modal('hide');
                $scope.chief_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add'){
            $http.post(url, {
                ChiefObjectiveName: $scope.chief_objective.ChiefObjectiveName,
                PerspectiveID: $scope.selectedUserProfile.PerspectiveID,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                $('#myModal').modal('hide');
                $scope.chief_objective = '';
                $scope.init();
                $scope.loading = false;
            });
        }
    };
 
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD CHIEF'S OBJECTIVE";
                document.getElementById('id_objective_name').value = "";
               
                break;
            case 'edit':
                $scope.form_title = "EDIT CHIEF'S OBJECTIVE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/chief_objectives/' + id)
                        .success(function(response) {
                            $scope.chief_objective = response;
                            $scope.selectedUserProfile = $scope.perspective[response.PerspectiveID-1];
                            console.log(response.PerspectiveID);
                        });
                break;
            default:
                break;
        }
        $('#myModal').modal('show');
    };

    $scope.init();

});