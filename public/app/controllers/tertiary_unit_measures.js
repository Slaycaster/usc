app.controller('APITertiaryUnitMeasureController', function($scope, $http, $interval) {

	$scope.tertiary_unit_measures = [];
	$scope.loading = true;
    $scope.info = false;


    
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/tertiary_unit_measures').
		success(function(data, status, headers, config) {
			$scope.tertiary_unit_measures = data;
				$scope.loading = false;
		});	
	};

    $http.get(public + 'api/secondary_unit/measures/secondary_unit_measures').
        success(function(data, status, headers, config)
        {   
           
            $scope.secondary_unit_measure = data;
            
            
            $scope.none = {SecondaryUnitMeasureID : 0, SecondaryUnitMeasureName: "None/No Contributory"};
          
            $scope.secondary_unit_measure.unshift($scope.none);
            
            $scope.selectedSecondaryUnitMeasure = $scope.secondary_unit_measure[0];


        });

     $scope.measureformula = [
                                    {SecondaryUnitMeasureFormula: "Summation"},
                                    {SecondaryUnitMeasureFormula: "Average"},
                                ];
            $scope.selectedMeasureFormula = $scope.measureformula[0];



    $http.get(public + 'api/tertiary_unit/measures/tertiary_unit_objectives').
        success(function(data, status, headers, config)
        {   
           
            $scope.tertiary_unit_objective = data;
            
            $scope.selectedTertiaryUnitObjective = $scope.tertiary_unit_objective[0];


        });

    $scope.getSecondaryUnitMeasureID = function(mes) 
    {
                
        
        var measureID = $scope.selectedSecondaryUnitMeasure.SecondaryUnitMeasureID;

        if(measureID != 0)
        {
             $http.get(public + 'tertiary_unit/angularsecondarymeasure/' + measureID).
            success(function(data)
            {   
               
                
                 $scope.measureformula = [
                                        {SecondaryUnitMeasureFormula: data.SecondaryUnitMeasureFormula},
                                    ];
                $scope.selectedMeasureFormula = $scope.measureformula[0]; 

            });

            $http.post(public + 'tertiaryunit/ifhascontributory/' + measureID).
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
                                    {SecondaryUnitMeasureFormula: "Summation"},
                                    {SecondaryUnitMeasureFormula: "Average"},
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
        var url = public + 'api/tertiary_unit_measures';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('tertiary_unit_id').value);
            $http.put(url, {
                TertiaryUnitMeasureName: $scope.tertiary_unit_measure.TertiaryUnitMeasureName,
                TertiaryUnitMeasureType: $scope.tertiary_unit_measure.TertiaryUnitMeasureType,
                TertiaryUnitMeasureFormula: $scope.selectedMeasureFormula.SecondaryUnitMeasureFormula,
                TertiaryUnitObjectiveID: $scope.selectedTertiaryUnitObjective.TertiaryUnitObjectiveID,
                SecondaryUnitMeasureID: $scope.selectedSecondaryUnitMeasure.SecondaryUnitMeasureID,
                TertiaryUnitID: document.getElementById('tertiary_unit_id').value,
                UserTertiaryUnitID: document.getElementById('user_tertiary_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.tertiary_unit_measures = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                TertiaryUnitMeasureName: $scope.tertiary_unit_measure.TertiaryUnitMeasureName,
                TertiaryUnitMeasureType: $scope.tertiary_unit_measure.TertiaryUnitMeasureType,
                TertiaryUnitMeasureFormula: $scope.selectedMeasureFormula.SecondaryUnitMeasureFormula,
                TertiaryUnitObjectiveID: $scope.selectedTertiaryUnitObjective.TertiaryUnitObjectiveID,
                SecondaryUnitMeasureID: $scope.selectedSecondaryUnitMeasure.SecondaryUnitMeasureID,
                TertiaryUnitID: document.getElementById('tertiary_unit_id').value,
                UserTertiaryUnitID: document.getElementById('user_tertiary_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(data);
                if(data == "true")
                {
                    $scope.istrue = "true";
                }
                else
                {

                $('#myModal').modal('hide');
                $scope.tertiary_unit_measures = '';
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
                $scope.form_title = "ADD TERTIARY UNIT'S MEASURE";
                document.getElementById('id_measure_name').value = "";
                document.getElementById('id_measure_type').checked = false;
                $scope.istrue = "false";
            
                break;
            case 'edit':
                $scope.form_title = "EDIT TERTIARY UNIT'S MEASURE DETAIL";
                $scope.id = id;
                $http.get(public + 'api/tertiary_unit_measures/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.tertiary_unit_measure = response;
                            //$scope.selectedTertiaryUnitObjective = $scope.tertiary_unit_objective[response.TertiaryUnitObjectiveID-1];
                            //$scope.selectedSecondaryUnitMeasure = $scope.SecondaryUnitmeasure[response.SecondaryUnitMeasureID];

                            angular.forEach($scope.measureformula, function(item){
                            

                                    if(item.SecondaryUnitMeasureFormula == response.TertiaryUnitMeasureFormula)
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[1];
                                    }
                                    else
                                    {
                                        $scope.selectedMeasureFormula = $scope.measureformula[0];
                                    }  
                                })

                             var x=0;
                            angular.forEach($scope.tertiary_unit_objective, function(item){
                                    
                                    if(item.TertiaryUnitObjectiveID == response.TertiaryUnitObjectiveID)
                                    {
                                        $scope.selectedTertiaryUnitObjective = $scope.tertiary_unit_objective[x];
                                    }
                                    x++;
                            })

                            var y=0;

                            angular.forEach($scope.secondary_unit_measure, function(item){
                                     
                                    if(item.SecondaryUnitMeasureID == response.SecondaryUnitMeasureID)
                                    {
                                        $scope.selectedSecondaryUnitMeasure = $scope.secondary_unit_measure[y];
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



