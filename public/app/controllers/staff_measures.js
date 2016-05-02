var local = 'http://' + location.host;

app.controller('APIStaffMeasureController', function($scope, $http, $interval) {

    $scope.staff_measures = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/staff_measures').
        success(function(data, status, headers, config) {
            $scope.staff_measures = data;
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
        var url = local + '/usc/public/api/staff_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('staff_id').value);
            $http.put(url, {
                StaffMeasureName: $scope.staff_measure.StaffMeasureName,
                StaffMeasureType: $scope.staff_measure.StaffMeasureType,
                StaffMeasureFormula: $scope.staff_measure.StaffMeasureFormula,
                ChiefMeasureID: $scope.staff_measure.ChiefMeasureID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.staff_measures = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                StaffMeasureName: $scope.staff_measure.StaffMeasureName,
                StaffMeasureType: $scope.staff_measure.StaffMeasureType,
                StaffMeasureFormula: $scope.staff_measure.StaffMeasureFormula,
                ChiefMeasureID: $scope.staff_measure.ChiefMeasureID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.staff_measures = '';
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
                $scope.form_title = "ADD STAFF'S MEASURE";
                document.getElementById('id_measure_name').value = "";
                document.getElementById('id_measure_type').checked = false;
                document.getElementById('id_measure_formula').value = "";
                document.getElementById('id_chief_measure').value = "0";
                break;
            case 'edit':
                $scope.form_title = "EDIT STAFF'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(local + '/usc/public/api/staff_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.staff_measure = response;
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

