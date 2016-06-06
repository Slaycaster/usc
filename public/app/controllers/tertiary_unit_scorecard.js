app.controller('APITertiaryUnitScorecardController', function($scope, $http, $interval) {
    
	$scope.tertiary_unit_targets = [];
    $scope.info = false;
	$scope.loading = true;
    
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
		$http.get(public + 'api/tertiary_unit_scorecard').
		success(function(data, status, headers, config) {
			$scope.tertiary_unit_targets = data;

            for(i = 1; i < $scope.tertiary_unit_targets.length; i++)
            {
               if($scope.tertiary_unit_targets[i - 1].tertiary_unit_measure.TertiaryUnitObjectiveID == $scope.tertiary_unit_targets[i].tertiary_unit_measure.TertiaryUnitObjectiveID )    
               {
                      $scope.tertiary_unit_targets[i].tertiary_unit_measure.tertiary_unit_objective.TertiaryUnitObjectiveName = " ";
               }
                
            }
			
            console.log(data);
			$scope.loading = false;
            $scope.info = true;
		});

        $http.get(public + 'api/tertiary_unit_scorecard/lastupdatedby').
        success(function(response){
            console.log(response.updated1);
            
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
        var url = public + 'api/tertiary_unit_scorecard';

            url += "/" + id;
            console.log(document.getElementById('id_owner'+id));

            $http.put(url, {
                TertiaryUnitOwnerContent: document.getElementById('id_owner'+id).value,
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
                TertiaryUnitInitiativeContent: document.getElementById('id_initiative'+id).value,
                TertiaryUnitFundingEstimate: document.getElementById('id_estimate'+id).value,
                TertiaryUnitFundingActual: document.getElementById('id_actual'+id).value,
                TertiaryUnitMeasureID: document.getElementById('unitmeasure_id'+id).value,
                TertiaryUnitID: document.getElementById('unit_id'+id).value,
                UserTertiaryUnitID: document.getElementById('user_unit_id'+id).value,
                Ownerpressed: $scope.changed,
                Accomplishmentpressed: $scope.accompchanged,
                Initiativepressed: $scope.initchanged,
                Fundingpressed: $scope.fundingchanged

            }).success(function(data, status, headers, config, response) {
                //console.log(response);
                $scope.tertiary_unit_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        // 
    };

    $scope.init();
});