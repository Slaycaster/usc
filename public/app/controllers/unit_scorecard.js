var local = 'http://' + location.host;

app.controller('APIUnitScorecardController', function($scope, $http, $interval) {
    
	$scope.unit_targets = [];
    $scope.info = false;
	$scope.loading = true;
    
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
		$http.get(local + '/usc/public/api/unit_scorecard').
		success(function(data, status, headers, config) {
			$scope.unit_targets = data;
            for(i = 1; i < $scope.unit_targets.length; i++)
            {
               if($scope.unit_targets[i - 1].unit_measure.UnitObjectiveID == $scope.unit_targets[i].unit_measure.UnitObjectiveID )    
               {
                      $scope.unit_targets[i].unit_measure.unit_objective.UnitObjectiveName = " ";
               }
                
            }
			console.log(data);
			$scope.loading = false;
            $scope.info = true;
		});

        $http.get(local + '/usc/public/api/unit_scorecard/lastupdatedby').
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
        var url = local + '/usc/public/api/unit_scorecard';

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