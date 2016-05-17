var local = 'http://' + location.host;

app.controller('APIChiefScorecardController', function($scope, $http, $interval) {

    $scope.chief_targets = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $http.get(local + '/usc/public/api/chief_scorecard').
        success(function(data, status, headers, config) {

            $scope.chief_targets = data;
            console.log($scope.chief_targets);
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
        var url = local + '/usc/public/api/chief_scorecard';
        
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