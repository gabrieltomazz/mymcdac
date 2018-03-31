app.controller("ProjectController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

	$scope.instance;
	$scope.scales;
	$scope.scales_main;
	$scope.scale_selected;

	


	$scope.isChecked = false;

    $scope.changeGood = function (option) {
        for(var i  in $scope.scale_selected.option_answer){
        	if($scope.scale_selected.option_answer[i].answer != option.answer && option.good == 1 ){
        		$scope.scale_selected.option_answer[i].good =0;
        	}
        } 
    };

    $scope.changeNeutral = function (option) {
        for(var i  in $scope.scale_selected.option_answer){
        	if($scope.scale_selected.option_answer[i].answer != option.answer && option.neutral == 1  ){
        		$scope.scale_selected.option_answer[i].neutral =0;
        	}
        } 
    };

	$scope.reset = function(){
		$scope.instance = {
			'id' : null,
		};
		$scope.scale_selected ={
			'description': null,
			'option_answer': [{ 
				'id': null,
 				'answer': null,
 				'neutral': 0,
 				'good': 0,
 				'delete':1,
 			}],
		};
	};


	$scope.addOp = function(){
		$scope.scale_selected.option_answer.push({ 
			'id': null,
			'answer': null,
			'neutral': 0,
			'good': 0,
			'delete': $scope.scale_selected.option_answer.length +1, 
 		});
	};

	$scope.find = function(id){

		loadingCenter("pageContent",true);
		//id=1
		getScaleByUser(id);
		$http.get('/projects/find/'+id).then(function (response) {

				$scope.instances = response.data;

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});

	};

	$scope.setDesempenho =  function(desempenho){

		$scope.instance.desempenho = desempenho.substring(0,3);
	};

	$scope.findProject = function(id,user_id){

		if (id == 'create'){
			return;
		}
		$scope.getScales(user_id);
		loadingCenter("pageContent",true);
		//id=1
		$http.get('/projects/find_project/'+id).then(function (response) {
			
			$scope.instance = response.data[0];
			$scope.scale = {'id' : response.data[0].scale_id};
				

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});
	

	};

	$scope.store = function(id){
		
		$scope.instance.user_id = id;
		$scope.instance.scale_id = $scope.scale.id;
		
		loadingCenter("pageContent",true);
		$http.post("/projects/store",$scope.instance).then(function (response) {

			if (!$scope.instance.id){
				$scope.instance = response.data;
			}

			appInfo("Successfully save!");

			$window.location.href = '/projects/'+response.data.id+'/criterio';

		}, function (response) {
		}).finally(function(){
			loadingCenter("pageContent",false);
		});


	};

	var getScaleByUser = function(id){
		loadingCenter("pageContent",true);
		$http.get('/scale/find_by_user/'+id).then(function (response) {

				$scope.scales_main = response.data;

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});


	};

	$scope.getScales = function(user_id){
		
		loadingCenter("pageContent",true);
		
		$http.get('/scale/all/'+user_id).then(function (response) {

				$scope.scales = response.data;

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});

	};

	$scope.findScale = function(id){

		for (var i in $scope.scales_main){

			if($scope.scales_main[i].id == id)
				$scope.scale_selected = $scope.scales_main[i]; 
		}
	};

	$scope.saveScales = function(id){

		var description="";
		if($scope.scale_selected.user_id == null)
			$scope.scale_selected.user_id = id;

		for(var i in $scope.scale_selected.option_answer)
		{
			if( i == 0){
				description = $scope.scale_selected.option_answer[i].answer;
			}else{
				description =  description + " - " + $scope.scale_selected.option_answer[i].answer;
			}  
		}
		$scope.scale_selected.description = description;
		
		$http.post("/scale/store",$scope.scale_selected).then(function (response) {

			appInfo("Successfully save!");

			getScaleByUser(response.data.user_id);

		}, function (response) {
		}).finally(function(){
			loadingCenter("pageContent",false);
		});
	
	};


	$scope.deleteOption = function(option){

		if (!confirm("Are you sure?"))
			return;

		if(option.id != null){
  			$http.get('/option_answer/remove/' + option.id).then(function (response) {
				
				arrRemove($scope.scale_selected.option_answer, option);
				$scope.saveScales();

			}, function (response) {
			}).finally(function () {

				loadingTop("pageBody", false);

			});
        }else{
			arrRemove($scope.scale_selected.option_answer, option);
        }
	};

	$scope.remove = function (instance) {

		if (!confirm("Are you sure?"))
			return;

		loadingTop("pageBody", true);

		$http.get('/projects/remove/' + instance.id).then(function (response) {

			arrRemove($scope.instances, instance);

		}, function (response) {
		}).finally(function () {

			loadingTop("pageBody", false);

		});

	};


	$scope.removeScale = function (scale) {

		for(var i in $scope.instances){
			if($scope.instances[i].scale_id == scale.id){
				alert("Não foi possivel apagar está Escala, pois está liga a um projeto.");
				return;
			}
		}

		if (!confirm("Are you sure?"))
			return;

		loadingTop("pageBody", true);

		$http.get('/scale/remove/' + scale.id).then(function (response) {

			arrRemove($scope.scales_main, scale);

		}, function (response) {
		}).finally(function () {

			loadingTop("pageBody", false);

		});

	};

	$scope.reset();

	// $timeout(function(){

	// 	$scope.getScales();

	// },100);

}]);


// 'option_answer': {
// 				'option1': [{ 
// 					'answer': 'very Poor',
// 				},{ 
// 					'answer': 'Neutral',
// 				},{ 
// 					'answer': 'Good',
// 				},{ 
// 					'answer': 'Very good',
// 				},{ 
// 					'answer': 'Excelent',
// 				}],
// 				'option2': [{ 
// 					'answer': 'Poor',
// 				},{ 
// 					'answer': 'Fair',
// 				},{ 
// 					'answer': 'Good',
// 				},{ 
// 					'answer': 'Very good',
// 				}],
// 				'option3': [{ 
// 					'answer': 'Very Poor',
// 				},{ 
// 					'answer': 'Poor',
// 				},{ 
// 					'answer': 'Fair',
// 				},{ 
// 					'answer': 'Good',
// 				},{ 
// 					'answer': 'Very good',
// 				}],
// 				'option4': [{ 
// 					'answer': 'Extremely bad',
// 				},{ 
// 					'answer': 'Very bad',
// 				},{ 
// 					'answer': 'bad ',
// 				},{ 
// 					'answer': 'good ',
// 				},{ 
// 					'answer': 'Very good',
// 				},{ 
// 					'answer': 'Extremely good',
// 				}],
// 				'option5': [{ 
// 					'answer': 'Very bad',
// 				},{ 
// 					'answer': 'bad',
// 				},{ 
// 					'answer': 'Somewhat good',
// 				},{ 
// 					'answer': 'Good',
// 				},{ 
// 					'answer': 'Very good',
// 				},{ 
// 					'answer': 'Extremely good',
// 				}],
// 				'others': [{ 
// 					'N':1 ,
// 					'answer': null,
// 				}],
// 				'positive': [{ 
// 					'answer': 'Extremely good',
// 				},{ 
// 					'answer': 'Very Good',
// 				},{ 
// 					'answer': 'Good',
// 				}],
// 				'negative': [{ 
// 					'answer': 'Poor',
// 				}],
// 				'neutral': [{ 
// 					'N':1 ,
// 					'answer': 'Neutral',
// 				}]
// 			}	