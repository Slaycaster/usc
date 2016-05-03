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
        var url = local + '/usc/public/api/chief_targets';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;
            console.log(document.getElementById('chief_id').value);
            $http.put(url, {
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
                TargetData: $scope.chief_target.TargetData,
                TargetPeriod: $scope.chief_target.TargetPeriod,
                ChiefMeasureID: document.getElementById('id_chief_measure').value,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
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
                TargetData: $scope.chief_target.TargetData,
                TargetPeriod: $scope.chief_target.TargetPeriod,
                ChiefMeasureID: document.getElementById('id_chief_measure').value,
                ChiefID: document.getElementById('chief_id').value,
                UserChiefID: document.getElementById('user_chief_id').value

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.chief_targets = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        // 
    };

    $scope.toggle = function(modalstate, id) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD TARGETS";
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
            console.log(id);
            $('#addModal').modal('show');

        switch (modalstate) {
            case 'view':
                $scope.form_title = "VIEW TARGET";
                $scope.id = id;
                $http.get(local + '/usc/public/api/chief_targets/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.chief_target = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#viewModal').modal('show');
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

