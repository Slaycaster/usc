app.controller('APIStaffMeasureController', function($scope, $http, $interval) {

    $scope.staff_measures = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/staff_measures').
        success(function(data, status, headers, config) {
            $scope.staff_measures = data;
                $scope.loading = false;
        });



         $http.get(public + 'api/staff/measures/chiefmeasures').
        success(function(data, status, headers, config)
        {   
           
            $scope.chiefmeasure = data;
            
            
            $scope.none = {ChiefMeasureID : 0, ChiefMeasureName: "None/No Contributory"};
          
            $scope.chiefmeasure.unshift($scope.none);
            //$scope.chiefobjective.push(data);
            $scope.selectedChiefMeasure = $scope.chiefmeasure[0];


        });

        $scope.measureformula = [
                                    {StaffMeasureFormula: "Summation"},
                                    {StaffMeasureFormula: "Average"},
                                ];
            $scope.selectedMeasureFormula = $scope.measureformula[0];
        

        $http.get(public + 'api/staff/measures/staffobjectives').
        success(function(data, status, headers, config)
        {   
           
            $scope.staffobjective = data;
            
            $scope.selectedStaffObjective = $scope.staffobjective[0];


        });

    };

      

    $scope.getChiefMeasureID = function(mes) 
    {
                

        var measureID = $scope.selectedChiefMeasure.ChiefMeasureID;





        if(measureID != 0)
        {
             $http.get(public + 'staff/angularchiefmeasure/' + measureID).
            success(function(data)
            {   
               
                
                 $scope.measureformula = [
                                        {StaffMeasureFormula: data.ChiefMeasureFormula},
                                    ];
                $scope.selectedMeasureFormula = $scope.measureformula[0]; 

            });

            $http.post(public + 'staff/ifhascontributory/' + measureID).
            success(function(data)
            {
                if(data == "true")
                {
                    $scope.hascontribute = "true";                    
                }
                if(data == "none")
                {
                    $scope.hascontribute = "false";
                }
            });

            
        }
        else
        {

            $scope.hascontribute = "false";

             $scope.measureformula = [
                                    {StaffMeasureFormula: "Summation"},
                                    {StaffMeasureFormula: "Average"},
                                ];
            $scope.selectedMeasureFormula = $scope.measureformula[0]; 


            
        }

        

                 
                
    };

    $scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };


    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = public + 'api/staff_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('staff_id').value);
            $http.put(url, {
                StaffMeasureName: $scope.staff_measure.StaffMeasureName,
                StaffMeasureType: $scope.staff_measure.StaffMeasureType,
                StaffMeasureFormula: $scope.selectedMeasureFormula.StaffMeasureFormula,
                StaffObjectiveID: $scope.selectedStaffObjective.StaffObjectiveID,
                ChiefMeasureID: $scope.selectedChiefMeasure.ChiefMeasureID,
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
                StaffMeasureFormula: $scope.selectedMeasureFormula.StaffMeasureFormula,
                StaffObjectiveID: $scope.selectedStaffObjective.StaffObjectiveID,
                ChiefMeasureID: $scope.selectedChiefMeasure.ChiefMeasureID,
                StaffID: document.getElementById('staff_id').value,
                UserStaffID: document.getElementById('user_staff_id').value

            }).success(function(data, status, headers, config, response) {
                
                if(data == "true")
                {
                     $scope.istrue = "true";
                }
                else
                {
                    $('#myModal').modal('hide');
                    $scope.staff_measures = '';
                    $scope.init();
                    $scope.loading = false;
                    
                }
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
                $scope.istrue = "false";
            
                
                
                break;
            case 'edit':
                $scope.form_title = "EDIT STAFF'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(public + 'api/staff_measures/' + id)
                        .success(function(response) {
                            
                            $scope.staff_measure = response;
                            //$scope.selectedStaffObjective = $scope.staffobjective[response.StaffObjectiveID];
                            //$scope.selectedChiefMeasure = $scope.chiefmeasure[response.ChiefMeasureID];

                            angular.forEach($scope.measureformula, function(item){
                              

                                    if(item.StaffMeasureFormula == response.StaffMeasureFormula)
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[1];
                                    }
                                    else
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[0];
                                    }  
                                })
                            var x=0;
                            angular.forEach($scope.staffobjective, function(item){
                                    
                                    if(item.StaffObjectiveID == response.StaffObjectiveID)
                                    {
                                        $scope.selectedStaffObjective = $scope.staffobjective[x];
                                    }
                                    x++;
                            })

                             var y=0;

                            angular.forEach($scope.chiefmeasure, function(item){
                                     
                                    if(item.ChiefMeasureID == response.ChiefMeasureID)
                                    {
                                        $scope.selectedChiefMeasure = $scope.chiefmeasure[y];
                                    }
                                    y++;
                            })
                            
                            // var mesid = response.ChiefMeasureID;
                            // $http.get(public + 'api/staff_measures/find/' + mesid)
                            //     .success(function(data){
                                
                                        
                            //         $scope.none2 = {ChiefMeasureID : data.ChiefMeasureID, ChiefMeasureName: data.ChiefMeasureName};
                                    
                            //         $scope.chiefmeasure.unshift($scope.none2);
            
                            //         $scope.selectedChiefMeasure = $scope.chiefmeasure[0];
                                   

                            //     });
                            console.log($scope.staffobjective.length);

                            
                        });
                break;
            default:
                break;
        }
        
        $('#myModal').modal('show');
    };

    $scope.init();

    
    //$interval( function(){ $scope.init(); }, 1000);
});

