app.controller('APIUnitMeasureController', function($scope, $http, $interval) {

	$scope.unit_measures = [];
	$scope.loading = true;
    $scope.info = false;


    
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/unit_measures').
		success(function(data, status, headers, config) {
			$scope.unit_measures = data;
				$scope.loading = false;
		});	
	};

    $http.get(public + 'api/staff/measures/staffmeasures').
        success(function(data, status, headers, config)
        {   
           
            $scope.staffmeasure = data;
            
            
            $scope.none = {StaffMeasureID : 0, StaffMeasureName: "None/No Contributory"};
          
            $scope.staffmeasure.unshift($scope.none);
            
            $scope.selectedStaffMeasure = $scope.staffmeasure[0];


        });

     $scope.measureformula = [
                                    {StaffMeasureFormula: "Summation"},
                                    {StaffMeasureFormula: "Average"},
                                ];
            $scope.selectedMeasureFormula = $scope.measureformula[0];



    $http.get(public + 'api/unit/measures/unitobjectives').
        success(function(data, status, headers, config)
        {   
           
            $scope.unitobjective = data;
            
            $scope.selectedUnitObjective = $scope.unitobjective[0];


        });

    $scope.getStaffMeasureID = function(mes) 
    {
                
        
        var measureID = $scope.selectedStaffMeasure.StaffMeasureID;

        if(measureID != 0)
        {
             $http.get(public + 'unit/angularstaffmeasure/' + measureID).
            success(function(data)
            {   
               
                
                 $scope.measureformula = [
                                        {StaffMeasureFormula: data.StaffMeasureFormula},
                                    ];
                $scope.selectedMeasureFormula = $scope.measureformula[0]; 

            });


             $http.post(public + 'unit/ifhascontributory/' + measureID).
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
        var url = public + 'api/unit_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('unit_id').value);
            $http.put(url, {
                UnitMeasureName: $scope.unit_measure.UnitMeasureName,
                UnitMeasureType: $scope.unit_measure.UnitMeasureType,
                UnitMeasureFormula: $scope.selectedMeasureFormula.StaffMeasureFormula,
                UnitObjectiveID: $scope.selectedUnitObjective.UnitObjectiveID,
                StaffMeasureID: $scope.selectedStaffMeasure.StaffMeasureID,
                UnitID: document.getElementById('unit_id').value,
                UserUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.unit_measures = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                UnitMeasureName: $scope.unit_measure.UnitMeasureName,
                UnitMeasureType: $scope.unit_measure.UnitMeasureType,
                UnitMeasureFormula: $scope.selectedMeasureFormula.StaffMeasureFormula,
                UnitObjectiveID: $scope.selectedUnitObjective.UnitObjectiveID,
                StaffMeasureID: $scope.selectedStaffMeasure.StaffMeasureID,
                UnitID: document.getElementById('unit_id').value,
                UserUnitID: document.getElementById('user_unit_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(data);
                if(data == "true")
                {
                    $scope.istrue = "true";
                }
                else
                {

                $('#myModal').modal('hide');
                $scope.unit_measures = '';
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
                $scope.form_title = "ADD UNIT'S MEASURE";
                document.getElementById('id_measure_name').value = "";
                document.getElementById('id_measure_type').checked = false;
                $scope.istrue = "false";
            
                break;
            case 'edit':
                $scope.form_title = "EDIT UNIT'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(public + 'api/unit_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_measure = response;
                            //$scope.selectedUnitObjective = $scope.unitobjective[response.UnitObjectiveID-1];
                            //$scope.selectedStaffMeasure = $scope.staffmeasure[response.StaffMeasureID];

                            angular.forEach($scope.measureformula, function(item){
                            

                                    if(item.StaffMeasureFormula == response.UnitMeasureFormula)
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[1];
                                    }
                                    else
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[0];
                                    }  
                                })

                             var x=0;
                            angular.forEach($scope.unitobjective, function(item){
                                    
                                    if(item.UnitObjectiveID == response.UnitObjectiveID)
                                    {
                                        $scope.selectedUnitObjective = $scope.unitobjective[x];
                                    }
                                    x++;
                            })

                             var y=0;

                            angular.forEach($scope.staffmeasure, function(item){
                                     
                                    if(item.StaffMeasureID == response.StaffMeasureID)
                                    {
                                        $scope.selectedStaffMeasure = $scope.staffmeasure[y];
                                    }
                                    y++;
                            })

                        });
                break;
            default:
                break;
                
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    $scope.init();

	//$interval( function(){ $scope.init(); }, 1000);
});



