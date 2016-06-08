var public = 'http://' + location.host + '/usc/public/';

app.controller('APISecondaryUnitScorecardController', function($scope, $http, $interval) {

    $scope.secondary_unit_targets = null;
    $scope.secondary_unit_january = [];
    $scope.secondary_unit_february = [];
    $scope.secondary_unit_march = [];
    $scope.secondary_unit_april = [];
    $scope.secondary_unit_may = [];
    $scope.secondary_unit_june = [];
    $scope.secondary_unit_july = [];
    $scope.secondary_unit_august = [];
    $scope.secondary_unit_september = [];
    $scope.secondary_unit_october = [];
    $scope.secondary_unit_november = [];
    $scope.secondary_unit_december = [];
    $scope.loading = true;
    $scope.info = false;

 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
        $http.get(public + 'api/secondary_unit_scorecard').
        success(function(data, status, headers, config) {
            console.log(data);
            $scope.secondary_unit_targets = data;

            //For Unit Accomplishment January
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_january[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_january[i] = $scope.secondary_unit_january[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].JanuaryAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_january[i] = 0;   
                    }
                }
            }
            //For Unit Accomplishment February
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_february[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_february[i] = $scope.secondary_unit_february[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].FebruaryAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_february[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment March
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_march[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_march[i] = $scope.secondary_unit_march[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].MarchAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_march[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment April
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_april[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_april[i] = $scope.secondary_unit_april[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].AprilAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_april[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment May
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_may[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_may[i] = $scope.secondary_unit_may[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].MayAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_may[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment June
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_june[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_june[i] = $scope.secondary_unit_june[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].JuneAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_june[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment July
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_july[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_july[i] = $scope.secondary_unit_july[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].JulyAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_july[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment August
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_august[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_august[i] = $scope.secondary_unit_august[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].AugustAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_august[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment September
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_september[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_september[i] = $scope.secondary_unit_september[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].SeptemberAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_september[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment October
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_october[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_october[i] = $scope.secondary_unit_october[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].OctoberAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_october[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment November
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_november[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_november[i] = $scope.secondary_unit_november[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].NovemberAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_november[i] = 0;   
                    }
                }
            }

            //For Unit Accomplishment December
            for(i = 0; i < $scope.secondary_unit_targets.length; i++)
            {
                $scope.secondary_unit_december[i] = 0;
                for(j = 0; j < $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures.length; j++)
                {
                    if($scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0] != null)
                    {
                        $scope.secondary_unit_december[i] = $scope.secondary_unit_december[i] + $scope.secondary_unit_targets[i].secondary_unit_measure.tertiary_unit_measures[j].tertiary_unit_accomplishments[0].DecemberAccomplishment;
                    }
                    else
                    {
                        $scope.secondary_unit_december[i] = 0;   
                    }
                }
            }

            for(i = 1; i < $scope.secondary_unit_targets.length; i++)
            {
                       if($scope.secondary_unit_targets[i - 1].secondary_unit_measure.SecondaryUnitObjectiveID == $scope.secondary_unit_targets[i].secondary_unit_measure.SecondaryUnitObjectiveID )    
                       {
                              $scope.secondary_unit_targets[i].secondary_unit_measure.secondary_unit_objective.SecondaryUnitObjectiveName = " ";
                       }
                
            }
                
            
                $scope.loading = false;
        }); 

         $http.get(public + 'api/secondary_unit/lastupdatedby').
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
        var url = public + 'api/secondary_unit_scorecard';
        
            url += "/" + id;

            $http.put(url, {
                SecondaryUnitOwnerContent: document.getElementById('id_owner'+id).value,
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
                SecondaryUnitInitiativeContent: document.getElementById('id_initiative'+id).value,
                SecondaryUnitFundingEstimate: document.getElementById('id_estimate'+id).value,
                SecondaryUnitFundingActual: document.getElementById('id_actual'+id).value,
                SecondaryUnitMeasureID: document.getElementById('staffmeasure_id'+id).value,
                SecondaryUnitID: document.getElementById('staff_id'+id).value,
                UserSecondaryUnitID: document.getElementById('user_staff_id'+id).value,
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