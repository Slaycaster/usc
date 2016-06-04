var public = 'http://' + location.host + '/usc/public/';

app.controller('APISecondaryUnitTargetController', function($scope, $http, $interval) {

	$scope.secondary_unit_targets = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/secondary_targets').
		success(function(data, status, headers, config) {
			$scope.secondary_targets = data;
				$scope.loading = false;

            $scope.date = new Date();

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
        var url = public + 'api/secondary_targets';

        //append Unit Objective ID to the URL if the form is in edit mode

        if (modalstate === 'show')
        {
            
            if(document.getElementById('id_target_period').value === "Monthly")
            {
                    url += "/update/" + id;
                    console.log("URL ID: " +id);
                    $http.post(url, {    
                        JanuaryTarget: $scope.unit_target.JanuaryTarget,
                        FebruaryTarget: $scope.unit_target.FebruaryTarget,
                        MarchTarget: $scope.unit_target.MarchTarget,
                        AprilTarget: $scope.unit_target.AprilTarget,
                        MayTarget: $scope.unit_target.MayTarget,
                        JuneTarget: $scope.unit_target.JuneTarget,
                        JulyTarget: $scope.unit_target.JulyTarget,
                        AugustTarget: $scope.unit_target.AugustTarget,
                        SeptemberTarget: $scope.unit_target.SeptemberTarget,
                        OctoberTarget: $scope.unit_target.OctoberTarget,
                        NovemberTarget: $scope.unit_target.NovemberTarget,
                        DecemberTarget: $scope.unit_target.DecemberTarget,
                        TargetDate:document.getElementById('target_date').value,
                        TargetPeriod: document.getElementById('id_target_period').value
                        


            

                    }).success(function(data, status, headers, config, response) {
        
                        $('#targetModal').modal('hide');
                        $scope.unit_targets = '';
                        $scope.init();
                        $scope.loading = false;
                    });
            }
            else if(document.getElementById('id_target_period').value === "Quarterly")
            {
                    url += "/updatequarter/" + id;

                    $http.post(url, {
                        
                        Quarter1:document.getElementById('id_firstquarter_target').value,
                        Quarter2:document.getElementById('id_secondquarter_target').value,
                        Quarter3:document.getElementById('id_thirdquarter_target').value,
                        Quarter4:document.getElementById('id_fourthquarter_target').value,
                        TargetDate:document.getElementById('target_date').value,
                        TargetPeriod: document.getElementById('id_target_period').value

                    }).success(function(data, status, headers, config, response) {
        
                        $('#targetModal').modal('hide');
                        $scope.unit_targets = '';
                        $scope.init();
                        $scope.loading = false;
                    });
            }
        }
        
        // 
    };

    $scope.toggle = function(modalstate, id, name) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'show':
                $scope.this_title = "ADD TARGETS";
                
                $scope.id = id;
                $http.get(public + 'api/unit_targets/' + id)
                .success(function(response) {            
                    $scope.unit_target = response;
                    console.log("SHOW" + $scope.unit_target.TargetPeriod);
                    if($scope.unit_target.TargetPeriod === 'Monthly' || $scope.unit_target.TargetPeriod === 'Quarterly')
                    {
                        $('#alreadysetModal').modal('show');
                    }
                    else
                    {
                        $('#targetModal').modal('show');
                    }
                });       

                $scope.unit_measurename = name;       
                document.getElementById('id_january_target').value = "";
                document.getElementById('id_february_target').value = "";
                document.getElementById('id_march_target').value = "";
                document.getElementById('id_april_target').value = "";
                document.getElementById('id_may_target').value = "";
                document.getElementById('id_june_target').value = "";
                document.getElementById('id_july_target').value = "";
                document.getElementById('id_august_target').value = "";
                document.getElementById('id_september_target').value = "";
                document.getElementById('id_october_target').value = "";
                document.getElementById('id_november_target').value = "";
                document.getElementById('id_december_target').value = "";
                break;
        
            case 'view':
                $scope.form_title = "VIEW TARGET";
                $scope.id = id;

                $http.get(public + 'api/unit_targets/' + id)

                .success(function(response) {
                    $scope.unit_target = response;
                    $scope.unit_measurename = name;
                    $scope.firstquarter = $scope.unit_target.JanuaryTarget;
                    $scope.secondquarter = $scope.unit_target.AprilTarget;
                    $scope.thirdquarter = $scope.unit_target.JulyTarget;
                    $scope.fourthquarter = $scope.unit_target.OctoberTarget;
                    $scope.firstquarter = parseFloat($scope.unit_target.JanuaryTarget + $scope.unit_target.FebruaryTarget + $scope.unit_target.MarchTarget).toFixed(2);
                    $scope.secondquarter = parseFloat($scope.unit_target.AprilTarget + $scope.unit_target.MayTarget + $scope.unit_target.JuneTarget).toFixed(2);
                    $scope.thirdquarter = parseFloat($scope.unit_target.JulyTarget + $scope.unit_target.AugustTarget + $scope.unit_target.SeptemberTarget).toFixed(2);
                    $scope.fourthquarter = parseFloat($scope.unit_target.OctoberTarget + $scope.unit_target.NovemberTarget + $scope.unit_target.DecemberTarget).toFixed(2);
                    //Quarter = Month Target * 3 || Di niyo pa rin gets no?
                    if ($scope.unit_target.TargetPeriod === 'Monthly')
                    {
                        $('#monthModal').modal('show');
                        $scope.init();               
                    }
                    else if ($scope.unit_target.TargetPeriod === 'Quarterly')
                    {
                        $('#quarterModal').modal('show');
                        $scope.init();
                    }
                    else
                    {
                        $('#notsetModal').modal('show');
                        $scope.init();
                    }
                });
                break;
                default:
                break;
       }
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

