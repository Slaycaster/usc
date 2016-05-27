var local = 'http://' + location.host;
var public = '/usc/public/'; // replace this with '/' for production

app.controller('APIChiefScorecardController', function($scope, $http, $interval) {

    $scope.chief_targets = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + public + 'api/chief_scorecard').
        success(function(data, status, headers, config) {
            //console.log(data);
           // console.log(data[1].chief_measure.staff_measures[0].unit_measures[0].unit_accomplishments[0]);
            $scope.chief_targets = data;

            for(i = 1; i < $scope.chief_targets.length; i++)
            {
                       if($scope.chief_targets[i - 1].chief_measure.ChiefObjectiveID == $scope.chief_targets[i].chief_measure.ChiefObjectiveID )    
                       {
                              $scope.chief_targets[i].chief_measure.chief_objective.ChiefObjectiveName = " ";
                       }
                
            }

            
            // Accumulating values from unit offices under staff and assigning it to StaffAccomplishment in order to have one summation of all.
            // All this, all contributory must have the same formula within!!!
            for (var i = 0, len = data.length; i < len; i++)
            {
                for (var j = 0, len2 = data[i].chief_measure.staff_measures.length; j < len2; j++)
                {
                    for (var j2 = 0, len22 = data[i].chief_measure.staff_measures[j].staff_accomplishments.length; j2 < len22; j2++)
                    {
                    }
                    for (var k = 0, len3 = data[i].chief_measure.staff_measures[j].unit_measures.length; k < len3; j++)
                    {
                        for (var l = 0, len4 = data[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments.length; l < len4; l++)
                        {
                            //console.log($scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].JanuaryAccomplishment)
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].JanuaryAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].JanuaryAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].FebruaryAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].FebruaryAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].MarchAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].MarchAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].AprilAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].AprilAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].MayAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].MayAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].JuneAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].JuneAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].JulyAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].JulyAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].AugustAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].AugustAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].SeptemberAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].SeptemberAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].OctoberAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].OctoberAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].NovemberAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].NovemberAccomplishment;
                            $scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].DecemberAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].DecemberAccomplishment;
                            //$scope.chief_targets[i].chief_measure.staff_measures[j].staff_accomplishments[0].JanuaryAccomplishment += $scope.chief_targets[i].chief_measure.staff_measures[j].unit_measures[k].unit_accomplishments[l].JanuaryAccomplishment;

                        }
                    }
                }
            }

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
        var url = local + public + 'api/chief_scorecard';
        
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