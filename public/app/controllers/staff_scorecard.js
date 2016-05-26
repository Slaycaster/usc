var local = 'http://' + location.host;
var public = '/usc/public/'; // replace this with '/' for production

app.controller('APIStaffScorecardController', function($scope, $http, $interval) {

	$scope.staff_targets = [];
  
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.changed = false;
        $scope.accompchanged = false;
        $scope.initchanged = false;
        $scope.fundingchanged = false;
		$http.get(local + public + 'api/staff_scorecard').
		success(function(data, status, headers, config) {
           
			$scope.staff_targets = data;

            for(i = 1; i < $scope.staff_targets.length; i++)
            {
                       if($scope.staff_targets[i - 1].staff_measure.StaffObjectiveID == $scope.staff_targets[i].staff_measure.StaffObjectiveID )    
                       {
                              $scope.staff_targets[i].staff_measure.staff_objective.StaffObjectiveName = " ";
                       }
                
            }

				$scope.loading = false;
		});	

        $http.get(local + public + 'api/staff_scorecard/lastupdatedby').
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
        var url = local + public + 'api/staff_scorecard';
        
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