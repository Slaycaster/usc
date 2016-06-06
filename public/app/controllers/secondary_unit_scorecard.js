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

        // $http.get(public + 'api/staff_scorecard/lastupdatedby').
        // success(function(response){
        //     console.log(response);
            
        //         $scope.updatedby = response.updated1;
        //         $scope.updatedby2 = response.updated2;
        //         $scope.updatedby3 = response.updated3;
        //         $scope.updatedby4 = response.updated4;
           

        //         $scope.updatedby.updated_at = Date.parse($scope.updatedby.updated_at);
        //         $scope.updatedby2.updated_at = Date.parse($scope.updatedby2.updated_at);
        //         $scope.updatedby3.updated_at = Date.parse($scope.updatedby3.updated_at);
        //         $scope.updatedby4.updated_at = Date.parse($scope.updatedby4.updated_at);

        //     $scope.loading = false;

        // }); 

                
    };


    $scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    

    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = public + 'api/chief_scorecard';
        
        //append Unit Objective ID to the URL if the form is in edit mode

            url += "/" + id;
            console.log(document.getElementById('chief_id'+id).value);
            $http.put(url, {
                ChiefOwnerContent: document.getElementById('id_owner'+id).value,
                /*
                JanuaryAccomplishment: document.getElementById('id_jan').value,
                FebruaryAccomplishment: document.getElementById('id_feb').value,
                MarchAccomplishment: document.getElementById('id_mar').value,
                AprilAccomplishment: document.getElementById('id_apr').value,
                MayAccomplishment: document.getElementById('id_may').value,
                JuneAccomplishment: document.getElementById('id_jun').value,
                JulyAccomplishment: document.getElementById('id_jul').value,
                AugustAccomplishment: document.getElementById('id_aug').value,
                SeptemberAccomplishment: document.getElementById('id_sep').value,
                OctoberAccomplishment: document.getElementById('id_oct').value,
                NovemberAccomplishment: document.getElementById('id_nov').value,
                DecemberAccomplishment: document.getElementById('id_dec').value,
                */
                ChiefInitiativeContent: document.getElementById('id_initiative'+id).value,
                ChiefFundingEstimate: document.getElementById('id_estimate'+id).value,
                ChiefFundingActual: document.getElementById('id_actual'+id).value,
                ChiefMeasureID: document.getElementById('chiefmeasure_id'+id).value,
                ChiefID: document.getElementById('chief_id'+id).value,
                UserChiefID: document.getElementById('user_chief_id'+id).value

            }).success(function(data, status, headers, config, response) {
                //console.log(response);
                $scope.chief_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        // 
    };


    $scope.init();
});