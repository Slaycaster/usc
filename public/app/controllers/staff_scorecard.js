app.controller('APIStaffScorecardController', function($scope, $http, $interval) {

	$scope.staff_targets = [];
    $scope.staff_january = [];
    $scope.staff_february = [];
    $scope.staff_march = [];
    $scope.staff_april = [];
    $scope.staff_may = [];
    $scope.staff_june = [];
    $scope.staff_july = [];
    $scope.staff_august = [];
    $scope.staff_september = [];
    $scope.staff_october = [];
    $scope.staff_november = [];
    $scope.staff_december = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
		$http.get(public + 'api/staff_scorecard').
		success(function(data, status, headers, config) {
           
			$scope.staff_targets = data;


            // for (var i = 0, len = data.length; i < len; i++)
            // {
            //     for (var j = 0, len2 = data[i].staff_measure.unit_measures.length; j < len2; j++)
            //     {
            //         if( !(typeof (data[i].staff_measure.unit_measures[j].secondary_unit_measures) === "undefined"))
            //         {        
            //             for (var k = 0, len3 = data[i].staff_measure.unit_measures[j].secondary_unit_measures.length; k < len3; k++)
            //             {   
            //                 if( !(typeof (data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures) === "undefined"))
            //                 {
            //                     for(var l = 0, len4 = data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures.length; l < len4; k++)
            //                     {
            //                         if( !(typeof (data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments) === "undefined"))
            //                         {
            //                             for(var m = 0, len5 = data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments.length; m < len5; m++)
            //                             {
            //                                 $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JanuaryAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures.secondary_unit_accomplishments[l].JanuaryAccomplishment + $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments[m].JanuaryAccomplishment;
            //                             }
            //                         }
            //                         break;
            //                     }
            //                 }
            //             }
            //         }
                    
                    
            //     }
            // }








            for (var i = 0, len = data.length; i < len; i++)
            {
                for (var j = 0, len2 = data[i].staff_measure.unit_measures.length; j < len2; j++)
                {
                    if( !(typeof (data[i].staff_measure.unit_measures[j].secondary_unit_measures) === "undefined"))
                    {        
                        for (var k = 0, len3 = data[i].staff_measure.unit_measures[j].secondary_unit_measures.length; k < len3; j++)
                        {   
                            //console.log(data[i].chief_measure.staff_measures[j].unit_measures[k]);
                            if(!(typeof(data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments) === "undefined"))
                            {    
                                    for (var l = 0, len4 = data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments.length; l < len4; l++)
                                    {
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JanuaryAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].JanuaryAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].FebruaryAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].FebruaryAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MarchAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].MarchAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AprilAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].AprilAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MayAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].MayAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JuneAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].JuneAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JulyAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].JulyAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AugustAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].AugustAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].SeptemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].SeptemberAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].OctoberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].OctoberAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].NovemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].NovemberAccomplishment;
                                        $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].DecemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].secondary_unit_accomplishments[l].DecemberAccomplishment;
                                        if(!(typeof(data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments) === "undefined"))
                                        { 
                                            for (var m = 0, len5 = data[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments.length; m < len5; m++)
                                            {
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JanuaryAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].JanuaryAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].FebruaryAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].FebruaryAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MarchAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].MarchAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AprilAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].AprilAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MayAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].MayAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JuneAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].JuneAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JulyAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].JulyAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AugustAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].AugustAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].SeptemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].SeptemberAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].OctoberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].OctoberAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].NovemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].NovemberAccomplishment;
                                                $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].DecemberAccomplishment += $scope.staff_targets[i].staff_measure.unit_measures[j].secondary_unit_measures[k].tertiary_unit_measures[l].tertiary_unit_accomplishments[m].DecemberAccomplishment;


                                            }
                                        }
                                    }                             
                            }
                            break;
                        }
                    }
                    
                    
                }
            }




            //For Unit Accomplishment January
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_january[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_january[i] = $scope.staff_january[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JanuaryAccomplishment;
                    }
                    else
                    {
                        $scope.staff_january[i] = 0;   
                    }
                }
            }
            //For Unit Accomplishment February
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_february[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_february[i] = $scope.staff_february[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].FebruaryAccomplishment;
                    }
                    else
                    {
                        $scope.staff_february[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment March
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_march[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_march[i] = $scope.staff_march[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MarchAccomplishment;
                    }
                    else
                    {
                        $scope.staff_march[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment April
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_april[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_april[i] = $scope.staff_april[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AprilAccomplishment;
                    }
                    else
                    {
                        $scope.staff_april[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment May
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_may[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_may[i] = $scope.staff_may[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].MayAccomplishment;
                    }
                    else
                    {
                        $scope.staff_may[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment June
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_june[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_june[i] = $scope.staff_june[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JuneAccomplishment;
                    }
                    else
                    {
                        $scope.staff_june[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment July
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_july[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_july[i] = $scope.staff_july[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].JulyAccomplishment;
                    }
                    else
                    {
                        $scope.staff_july[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment August
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_august[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_august[i] = $scope.staff_august[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].AugustAccomplishment;
                    }
                    else
                    {
                        $scope.staff_august[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment September
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_september[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_september[i] = $scope.staff_september[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].SeptemberAccomplishment;
                    }
                    else
                    {
                        $scope.staff_september[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment October
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_october[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_october[i] = $scope.staff_october[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].OctoberAccomplishment;
                    }
                    else
                    {
                        $scope.staff_october[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment November
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_november[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_november[i] = $scope.staff_november[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].NovemberAccomplishment;
                    }
                    else
                    {
                        $scope.staff_november[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment December
            for(i = 0; i < $scope.staff_targets.length; i++)
            {
                $scope.staff_december[i] = 0;
                for(j = 0; j < $scope.staff_targets[i].staff_measure.unit_measures.length; j++)
                {
                    if($scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0] != null)
                    {
                        $scope.staff_december[i] = $scope.staff_december[i] + $scope.staff_targets[i].staff_measure.unit_measures[j].unit_accomplishments[0].DecemberAccomplishment;
                    }
                    else
                    {
                        $scope.staff_december[i] = 0;   
                    }
                }
            }

            for(i = 1; i < $scope.staff_targets.length; i++)
            {
                       if($scope.staff_targets[i - 1].staff_measure.StaffObjectiveID == $scope.staff_targets[i].staff_measure.StaffObjectiveID )    
                       {
                              $scope.staff_targets[i].staff_measure.staff_objective.StaffObjectiveName = " ";
                       }
                
            }
                console.log($scope.staff_january);
				$scope.loading = false;
		});	

        $http.get(public + 'api/staff_scorecard/lastupdatedby').
        success(function(response){
            console.log(response);
            
                $scope.updatedby = response.updated1;
                $scope.updatedby2 = response.updated2;
                $scope.updatedby3 = response.updated3;
                $scope.updatedby4 = response.updated4;
           

                $scope.updatedby.updated_at = Date.parse($scope.updatedby.updated_at);
                $scope.updatedby2.updated_at = Date.parse($scope.updatedby2.updated_at);
                $scope.updatedby3.updated_at = Date.parse($scope.updatedby3.updated_at);
                $scope.updatedby4.updated_at = Date.parse($scope.updatedby4.updated_at);

            $scope.loading = false;

        }); 

                
	};

   
    
    $scope.ownerchange = function() 
    {
                
        $scope.changed = true;
       
                
                
    };

    $scope.accompchange = function()
    {   
        $scope.accompchanged = true;


    }

    $scope.initchange = function()
    {
        $scope.initchanged = true;
    }

    $scope.fundingchange = function()
    {
        $scope.fundingchanged = true;
    }

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    

    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = public + 'api/staff_scorecard';
        
            url += "/" + id;
            console.log(document.getElementById('id_owner'+id));
            
            $http.put(url, {
                StaffOwnerContent: document.getElementById('id_owner'+id).value,
                JanuaryAccomplishment: document.getElementById('id_jan'+id).value,
                FebruaryAccomplishment: document.getElementById('id_feb'+id).value,
                MarchAccomplishment: document.getElementById('id_mar'+id).value,
                AprilAccomplishment: document.getElementById('id_apr'+id).value,
                MayAccomplishment: document.getElementById('id_may'+id).value,
                JuneAccomplishment: document.getElementById('id_jun'+id).value,
                JulyAccomplishment: document.getElementById('id_jul'+id).value,
                AugustAccomplishment: document.getElementById('id_aug'+id).value,
                SeptemberAccomplishment: document.getElementById('id_sep'+id).value,
                OctoberAccomplishment: document.getElementById('id_oct'+id).value,
                NovemberAccomplishment: document.getElementById('id_nov'+id).value,
                DecemberAccomplishment: document.getElementById('id_dec'+id).value,
                StaffInitiativeContent: document.getElementById('id_initiative'+id).value,
                StaffFundingEstimate: document.getElementById('id_estimate'+id).value,
                StaffFundingActual: document.getElementById('id_actual'+id).value,
                StaffMeasureID: document.getElementById('staffmeasure_id'+id).value,
                StaffID: document.getElementById('staff_id'+id).value,
                UserStaffID: document.getElementById('user_staff_id'+id).value,
                Ownerpressed: $scope.changed,
                Accomplishmentpressed: $scope.accompchanged,
                Initiativepressed: $scope.initchanged,
                Fundingpressed: $scope.fundingchanged

            }).success(function(data, status, headers, config, response) {
                //console.log(response);
                $scope.staff_targets = '';
                $scope.init();
                $scope.loading = false;
            });

        // 

    };


    $scope.init();
});