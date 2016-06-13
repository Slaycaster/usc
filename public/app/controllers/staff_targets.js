app.controller('APIStaffTargetController', function($scope, $http, $interval) {
	$scope.staff_targets = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
        $scope.istrue="false";
		$http.get(public + 'api/staff_targets').
		success(function(data, status, headers, config) {
			$scope.staff_targets = data;
				$scope.loading = false;

            $scope.date = new Date();

		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.getpassword = function() 
    {
        var url = public + 'api/staff_confirm_password';
        $http.post(url, {    
            getPassword: document.getElementById('getPassword').value
        }).success(function(data, status, headers, config, response) {

            console.log(data);
            if(data == "TRUE")
            {
                $scope.istrue = "true";

            }
            else
            {
                $scope.istrue = "false";
            }
        });
    }

    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = public + 'api/staff_targets';

        //append Unit Objective ID to the URL if the form is in edit mode

        if (modalstate === 'show')
        {
            
            if(document.getElementById('id_target_period').value === "Monthly")
            {
                    url += "/update/" + id;
                    $http.post(url, {    
                        JanuaryTarget: $scope.staff_target.JanuaryTarget,
                        FebruaryTarget: $scope.staff_target.FebruaryTarget,
                        MarchTarget: $scope.staff_target.MarchTarget,
                        AprilTarget: $scope.staff_target.AprilTarget,
                        MayTarget: $scope.staff_target.MayTarget,
                        JuneTarget: $scope.staff_target.JuneTarget,
                        JulyTarget: $scope.staff_target.JulyTarget,
                        AugustTarget: $scope.staff_target.AugustTarget,
                        SeptemberTarget: $scope.staff_target.SeptemberTarget,
                        OctoberTarget: $scope.staff_target.OctoberTarget,
                        NovemberTarget: $scope.staff_target.NovemberTarget,
                        DecemberTarget: $scope.staff_target.DecemberTarget,
                        TargetDate:document.getElementById('target_date').value,
                        TargetPeriod: document.getElementById('id_target_period').value
                        


            

                    }).success(function(data, status, headers, config, response) {
        
                        $('#targetModal').modal('hide');
                        $scope.staff_targets = '';
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
                        $scope.staff_targets = '';
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
                $http.get(public + 'api/staff_targets/' + id)
                .success(function(response) {            
                    $scope.staff_target = response;
                    $scope.quarter1 = parseFloat($scope.staff_target.JanuaryTarget + $scope.staff_target.FebruaryTarget + $scope.staff_target.MarchTarget).toFixed(2);
                    $scope.quarter2 = parseFloat($scope.staff_target.AprilTarget + $scope.staff_target.MayTarget + $scope.staff_target.JuneTarget).toFixed(2);
                    $scope.quarter3 = parseFloat($scope.staff_target.JulyTarget + $scope.staff_target.AugustTarget + $scope.staff_target.SeptemberTarget).toFixed(2);
                    $scope.quarter4 = parseFloat($scope.staff_target.OctoberTarget + $scope.staff_target.NovemberTarget + $scope.staff_target.DecemberTarget).toFixed(2);
                    console.log("SHOW" + $scope.staff_target.TargetPeriod);
                    if($scope.staff_target.TargetPeriod === 'Monthly' || $scope.staff_target.TargetPeriod === 'Quarterly')
                    {
                        $('#alreadysetModal').modal('show');
                        $scope.init();
                    }
                    else
                    {
                        $('#targetModal').modal('show');
                        $scope.init();
                    }
                });       

                $scope.staff_measurename = name;       
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

                $http.get(public + 'api/staff_targets/' + id)

                .success(function(response) {
                    $scope.staff_target = response;
                    $scope.staff_measurename = name;
                    $scope.firstquarter = $scope.staff_target.JanuaryTarget;
                    $scope.secondquarter = $scope.staff_target.AprilTarget;
                    $scope.thirdquarter = $scope.staff_target.JulyTarget;
                    $scope.fourthquarter = $scope.staff_target.OctoberTarget;
                    $scope.firstquarter = parseFloat($scope.staff_target.JanuaryTarget + $scope.staff_target.FebruaryTarget + $scope.staff_target.MarchTarget).toFixed(2);
                    $scope.secondquarter = parseFloat($scope.staff_target.AprilTarget + $scope.staff_target.MayTarget + $scope.staff_target.JuneTarget).toFixed(2);
                    $scope.thirdquarter = parseFloat($scope.staff_target.JulyTarget + $scope.staff_target.AugustTarget + $scope.staff_target.SeptemberTarget).toFixed(2);
                    $scope.fourthquarter = parseFloat($scope.staff_target.OctoberTarget + $scope.staff_target.NovemberTarget + $scope.staff_target.DecemberTarget).toFixed(2);
                    //Quarter = Month Target * 3 || Di niyo pa rin gets no?
                    if ($scope.staff_target.TargetPeriod === 'Monthly')
                    {
                        $('#monthModal').modal('show');
                        $scope.init();               
                    }
                    else if ($scope.staff_target.TargetPeriod === 'Quarterly')
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

