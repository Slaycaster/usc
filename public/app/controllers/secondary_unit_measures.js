app.controller('APISecondaryUnitMeasureController', function($scope, $http, $interval) {

	$scope.secondary_unit_measures = [];
	$scope.loading = true;
    $scope.info = false;


    
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/secondary_unit_measures').
		success(function(data, status, headers, config) {
			$scope.secondary_unit_measures = data;
				$scope.loading = false;
		});	
	};

    $http.get(public + 'api/secondaryunit/measures/unitmeasures').
        success(function(data, status, headers, config)
        {   
           
            $scope.staffmeasure = data;
            
            
            $scope.none = {UnitMeasureID : 0, UnitMeasureName: "None/No Contributory"};
          
            $scope.staffmeasure.unshift($scope.none);
            
            $scope.selectedStaffMeasure = $scope.staffmeasure[0];


        });

     $scope.measureformula = [
                                    {UnitMeasureFormula: "Summation"},
                                    {UnitMeasureFormula: "Average"},
                                ];
            $scope.selectedMeasureFormula = $scope.measureformula[0];



    $http.get(public + 'api/secondaryunit/measures/secondaryunitobjectives').
        success(function(data, status, headers, config)
        {   
           
            $scope.unitobjective = data;
            
            $scope.selectedUnitObjective = $scope.unitobjective[0];


        });

    $scope.getStaffMeasureID = function(mes) 
    {
                
        
        var measureID = $scope.selectedStaffMeasure.UnitMeasureID;

        if(measureID != 0)
        {
             $http.get(public + 'secondaryunit/angularunitmeasure/' + measureID).
            success(function(data)
            {   
               
                
                 $scope.measureformula = [
                                        {UnitMeasureFormula: data.UnitMeasureFormula},
                                    ];
                $scope.selectedMeasureFormula = $scope.measureformula[0]; 

            });
            
        }
        else
        {
             $scope.measureformula = [
                                    {UnitMeasureFormula: "Summation"},
                                    {UnitMeasureFormula: "Average"},
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
        var url = public + 'api/secondary_unit_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('unit_id').value);
            $http.put(url, {
                SecondaryUnitMeasureName: $scope.unit_measure.SecondaryUnitMeasureName,
                SecondaryUnitMeasureType: $scope.unit_measure.SecondaryUnitMeasureType,
                SecondaryUnitMeasureFormula: $scope.selectedMeasureFormula.UnitMeasureFormula,
                SecondaryUnitObjectiveID: $scope.selectedUnitObjective.SecondaryUnitObjectiveID,
                UnitMeasureID: $scope.selectedStaffMeasure.UnitMeasureID,
                SecondaryUnitID: document.getElementById('unit_id').value,
                UserSecondaryUnitID: document.getElementById('user_unit_id').value

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
                SecondaryUnitMeasureName: $scope.unit_measure.SecondaryUnitMeasureName,
                SecondaryUnitMeasureType: $scope.unit_measure.SecondaryUnitMeasureType,
                SecondaryUnitMeasureFormula: $scope.selectedMeasureFormula.UnitMeasureFormula,
                SecondaryUnitObjectiveID: $scope.selectedUnitObjective.SecondaryUnitObjectiveID,
                UnitMeasureID: $scope.selectedStaffMeasure.UnitMeasureID,
                SecondaryUnitID: document.getElementById('unit_id').value,
                UserSecondaryUnitID: document.getElementById('user_unit_id').value

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
                $http.get(public + 'api/secondary_unit_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.unit_measure = response;
                            $scope.selectedUnitObjective = $scope.unitobjective[response.SecondaryUnitObjectiveID-1];
                            $scope.selectedStaffMeasure = $scope.staffmeasure[response.UnitMeasureID];

                            angular.forEach($scope.measureformula, function(item){
                            

                                    if(item.UnitMeasureFormula == response.SecondaryUnitMeasureFormula)
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[1];
                                    }
                                    else
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[0];
                                    }  
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



