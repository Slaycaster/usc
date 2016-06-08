app.controller('APIUnitScorecardController', function($scope, $http, $interval) {
    
	$scope.unit_targets = null;
    $scope.unit_january = [];
    $scope.unit_february = [];
    $scope.unit_march = [];
    $scope.unit_april = [];
    $scope.unit_may = [];
    $scope.unit_june = [];
    $scope.unit_july = [];
    $scope.unit_august = [];
    $scope.unit_september = [];
    $scope.unit_october = [];
    $scope.unit_november = [];
    $scope.unit_december = [];
    $scope.info = false;
	$scope.loading = true;
    
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
		$http.get(public + 'api/unit_scorecard').
		success(function(data, status, headers, config) {
			$scope.unit_targets = data;
            for(i = 1; i < $scope.unit_targets.length; i++)
            {
               if($scope.unit_targets[i - 1].unit_measure.UnitObjectiveID == $scope.unit_targets[i].unit_measure.UnitObjectiveID )    
               {
                      $scope.unit_targets[i].unit_measure.unit_objective.UnitObjectiveName = " ";
               }
                
            }

            // Accumulating values from unit offices under secondary_unit and assigning it to secondary_unitAccomplishment in order to have one summation of all.
            // All this, all contributory must have the same formula within!!!
            for (var i = 0, len = data.length; i < len; i++)
            {
                for (var j = 0, len2 = data[i].unit_measure.secondary_unit_measures.length; j < len2; j++)
                {
                    if( !(typeof (data[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures) === "undefined"))
                    {        
                        for (var k = 0, len3 = data[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures.length; k < len3; j++)
                        {   
                            //console.log(data[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k]);
                            if(!(typeof(data[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments) === "undefined"))
                            {    
                                    for (var l = 0, len4 = data[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments.length; l < len4; l++)
                                    {
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JanuaryAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].JanuaryAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].FebruaryAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].FebruaryAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].MarchAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].MarchAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].AprilAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].AprilAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].MayAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].MayAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JuneAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].JuneAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JulyAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].JulyAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].AugustAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].AugustAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].SeptemberAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].SeptemberAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].OctoberAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].OctoberAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].NovemberAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].NovemberAccomplishment;
                                        $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].DecemberAccomplishment += $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].tertiary_unit_measures[k].tertiary_unit_accomplishments[l].DecemberAccomplishment;   
                                    }                             
                            }
                            break;
                        }
                    }
                    
                    
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_january[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_january[i] = $scope.unit_january[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JanuaryAccomplishment;
                    }
                    else
                    {
                        $scope.unit_january[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_february[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_february[i] = $scope.unit_february[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].FebruaryAccomplishment;
                    }
                    else
                    {
                        $scope.unit_february[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_march[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_march[i] = $scope.unit_march[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].MarchAccomplishment;
                    }
                    else
                    {
                        $scope.unit_march[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_april[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_april[i] = $scope.unit_april[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].AprilAccomplishment;
                    }
                    else
                    {
                        $scope.unit_april[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_may[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_may[i] = $scope.unit_may[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].MayAccomplishment;
                    }
                    else
                    {
                        $scope.unit_may[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_june[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_june[i] = $scope.unit_june[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JuneAccomplishment;
                    }
                    else
                    {
                        $scope.unit_june[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_july[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_july[i] = $scope.unit_july[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].JulyAccomplishment;
                    }
                    else
                    {
                        $scope.unit_july[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_august[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_august[i] = $scope.unit_august[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].AugustAccomplishment;
                    }
                    else
                    {
                        $scope.unit_august[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_september[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_september[i] = $scope.unit_september[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].SeptemberAccomplishment;
                    }
                    else
                    {
                        $scope.unit_september[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_october[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_october[i] = $scope.unit_october[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].OctoberAccomplishment;
                    }
                    else
                    {
                        $scope.unit_october[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_november[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_november[i] = $scope.unit_november[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].NovemberAccomplishment;
                    }
                    else
                    {
                        $scope.unit_november[i] = 0;   
                    }
                }
            }

            for(i = 0; i < $scope.unit_targets.length; i++)
            {
                $scope.unit_december[i] = 0;
                for(j = 0; j < $scope.unit_targets[i].unit_measure.secondary_unit_measures.length; j++)
                {
                    if($scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0] != null)
                    {
                        $scope.unit_december[i] = $scope.unit_december[i] + $scope.unit_targets[i].unit_measure.secondary_unit_measures[j].secondary_unit_accomplishments[0].DecemberAccomplishment;
                    }
                    else
                    {
                        $scope.unit_december[i] = 0;   
                    }
                }
            }


			console.log(data);
			$scope.loading = false;
            $scope.info = true;
		});

        $http.get(public + 'api/unit_scorecard/lastupdatedby').
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
        var url = public + 'api/unit_scorecard';

            url += "/" + id;
            console.log(document.getElementById('id_owner'+id));

            $http.put(url, {
                UnitOwnerContent: document.getElementById('id_owner'+id).value,
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
                UnitInitiativeContent: document.getElementById('id_initiative'+id).value,
                UnitFundingEstimate: document.getElementById('id_estimate'+id).value,
                UnitFundingActual: document.getElementById('id_actual'+id).value,
                UnitMeasureID: document.getElementById('unitmeasure_id'+id).value,
                UnitID: document.getElementById('unit_id'+id).value,
                UserUnitID: document.getElementById('user_unit_id'+id).value,
                Ownerpressed: $scope.changed,
                Accomplishmentpressed: $scope.accompchanged,
                Initiativepressed: $scope.initchanged,
                Fundingpressed: $scope.fundingchanged

            }).success(function(data, status, headers, config, response) {
                //console.log(response);
                $scope.unit_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        // 
    };

    $scope.init();
});