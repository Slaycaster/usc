var local = 'http://' + location.host;

app.controller('APIChiefTargetController', function($scope, $http, $interval) {

	$scope.chief_targets = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(local + '/usc/public/api/chief_targets').
		success(function(data, status, headers, config) {
			$scope.chief_targets = data;
            console.log(data);
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
        var url = local + '/usc/public/api/chief_targets';

        //append Unit Objective ID to the URL if the form is in edit mode

        if (modalstate === 'show')
        {
            
            if(document.getElementById('id_target_period').value === "Monthly")
            {
                    url += "/update/" + id;
                    $http.post(url, {    
                        JanuaryTarget: $scope.chief_target.JanuaryTarget,
                        FebruaryTarget: $scope.chief_target.FebruaryTarget,
                        MarchTarget: $scope.chief_target.MarchTarget,
                        AprilTarget: $scope.chief_target.AprilTarget,
                        MayTarget: $scope.chief_target.MayTarget,
                        JuneTarget: $scope.chief_target.JuneTarget,
                        JulyTarget: $scope.chief_target.JulyTarget,
                        AugustTarget: $scope.chief_target.AugustTarget,
                        SeptemberTarget: $scope.chief_target.SeptemberTarget,
                        OctoberTarget: $scope.chief_target.OctoberTarget,
                        NovemberTarget: $scope.chief_target.NovemberTarget,
                        DecemberTarget: $scope.chief_target.DecemberTarget,
                        TargetDate:document.getElementById('target_date').value,
                        TargetPeriod: document.getElementById('id_target_period').value
                        


            

                    }).success(function(data, status, headers, config, response) {
                        console.log(response);
                        $('#targetModal').modal('hide');
                        $scope.chief_targets = '';
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
                        console.log(response);
                        $('#targetModal').modal('hide');
                        $scope.chief_targets = '';
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
        $scope.chief_target = [];
        switch (modalstate) {
            case 'show':
                $scope.this_title = "ADD TARGETS";
                
                $scope.id = id;
                $http.get(local + '/usc/public/api/chief_targets/' + id)
                        .success(function(response) {
                            $scope.chief_target = response;
                        });       

                            $scope.chief_measurename = name;       
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
                default:
                break;
            }
            

        switch (modalstate) {
            case 'view':
                $scope.form_title = "VIEW TARGET";
                $scope.id = id;

                $http.get(local + '/usc/public/api/chief_targets/' + id)
                        .success(function(response) {
                            $scope.chief_target = response;
                            $scope.chief_measurename = name;

                            $scope.firstquarter = parseFloat($scope.chief_target.JanuaryTarget + $scope.chief_target.FebruaryTarget + $scope.chief_target.MarchTarget).toFixed(2);
                            $scope.secondquarter = parseFloat($scope.chief_target.AprilTarget + $scope.chief_target.MayTarget + $scope.chief_target.JuneTarget).toFixed(2);
                            $scope.thirdquarter = parseFloat($scope.chief_target.JulyTarget + $scope.chief_target.AugustTarget + $scope.chief_target.SeptemberTarget).toFixed(2);
                            $scope.fourthquarter = parseFloat($scope.chief_target.OctoberTarget + $scope.chief_target.NovemberTarget + $scope.chief_target.DecemberTarget).toFixed(2);
                            
                        });

                        //Quarter = Month Target * 3 || Di niyo pa rin gets no?
                break;
            default:
                break;
        }
        

        if (modalstate === 'show')
        {
            $('#targetModal').modal('show');
        }
        else if (modalstate === 'view')
        {
            $http.get(local + '/usc/public/api/chief_targets/' + id)
                .success(function(response) {
                    $scope.chief_target = response;

                    if ($scope.chief_target.TargetPeriod === 'Monthly')
                    {
                        $('#monthModal').modal('show');
                        $scope.init();               
                    }
                    else if ($scope.chief_target.TargetPeriod === 'Quarterly')
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

        }

       
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

