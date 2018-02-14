app.controller("ProjectController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

	$scope.instance;
	$scope.old_option;
	$scope.filtros = {
		'filtros': {
			'limit': 100
		}
	};
	$scope.reloadPage = function(){
		location.reload();
	};
	$scope.reset = function(){
		$scope.instance = {
			'id' : null,
			'option_answer': {
				'option1': [{ 
					'answer': 'Poor',
				},{ 
					'answer': 'Fair',
				},{ 
					'answer': 'Good',
				},{ 
					'answer': 'Very good',
				}],
				'option2': [{ 
					'answer': 'Very Poor',
				},{ 
					'answer': 'Poor',
				},{ 
					'answer': 'Fair',
				},{ 
					'answer': 'Good',
				},{ 
					'answer': 'Very good',
				}],
				'option3': [{ 
					'answer': 'Extremely bad',
				},{ 
					'answer': 'Very bad',
				},{ 
					'answer': 'bad ',
				},{ 
					'answer': 'good ',
				},{ 
					'answer': 'Very good',
				},{ 
					'answer': 'Extremely good',
				}],
				'option4': [{ 
					'answer': 'Very bad',
				},{ 
					'answer': 'bad',
				},{ 
					'answer': 'Somewhat good',
				},{ 
					'answer': 'Good',
				},{ 
					'answer': 'Very good',
				},{ 
					'answer': 'Extremely good',
				}],
				'others': [{ 
					'N':1 ,
					'answer': null,
				}],
				'positive': [{ 
					'answer': 'Extremely good',
				},{ 
					'answer': 'Very Good',
				},{ 
					'answer': 'Good',
				}],
				'negative': [{ 
					'answer': 'Poor',
				}],
				'neutral': [{ 
					'N':1 ,
					'answer': 'Neutral',
				}]
			}	
		};
	};


	$scope.addOp = function(){
		$scope.instance.option_answer.others.push({'answer': null,});

	};

	$scope.addOpPositive = function(){
		$scope.instance.option_answer.positive.unshift({'answer': null,});

	};
	$scope.addOpNegative= function(){
		$scope.instance.option_answer.negative.push({'answer': null,});

	};

	$scope.find = function(id){

		loadingCenter("pageContent",true);
		//id=1
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

	$scope.findProject = function(id){

		if (id == 'create'){
			return;
		}

		loadingCenter("pageContent",true);
		//id=1
		$http.get('/projects/find_project/'+id).then(function (response) {

			$scope.instance.option_answer[response.data.option] = response.data.option_answer;
			$scope.old_option = response.data.option;
			response.data.option_answer = $scope.instance.option_answer;
			$scope.instance = response.data;

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});

	};

	$scope.store = function(id){
		
		$scope.instance.user_id = id;
		loadingCenter("pageContent",true);
		if($scope.old_option != $scope.instance.option){
			deleteOptionBeforeSaveNew($scope.instance.id)
		}
		prepareToSaveOptionsAnswer($scope.instance.option_answer[$scope.instance.option],$scope.instance.option);
		$http.post("/projects/store",$scope.instance).then(function (response) {

			if (!$scope.instance.id){
				$scope.instance = response.data;
			}

			appInfo("Registro salvo com sucesso!");

			$window.location.href = '/projects/'+response.data.id+'/criterio/level';

		}, function (response) {
		}).finally(function(){
			loadingCenter("pageContent",false);
		});


	};
	var prepareToSaveOptionsAnswer = function(options,option){

		for(var i in options){
			if(options[i].id == null){
				$scope.instance.option_answer[option][i].id = null;
			}
		}
		$scope.instance.option_answer = $scope.instance.option_answer[option];
	};

	var deleteOptionBeforeSaveNew = function(project_id){

		$http.get('/option_answer/remove_by_project/' + project_id).then(function (response) {


			}, function (response) {
			}).finally(function () {

				loadingTop("pageBody", false);

		});

	}

	$scope.deleteOption = function(scope){

		if(scope.option.id == null){
        	for(var i in $scope.instance.option_answer['others']){
            	if($scope.instance.option_answer['others'][i].N == scope.option.N){
            		arrRemove($scope.instance.option_answer['others'],$scope.instance.option_answer['others'][i]);
            		return;
            	}
            }
        }else{
        	$http.get('/option_answer/remove/' + scope.option.id).then(function (response) {

				arrRemove($scope.instance.option_answer[$scope.instance.option], scope.option);

			}, function (response) {
			}).finally(function () {

				loadingTop("pageBody", false);

			});

        }
	};

	$scope.remove = function (instance) {

		if (!confirm("Confirma a exclusão deste registro?"))
			return;

		loadingTop("pageBody", true);

		$http.get('/projects/remove/' + instance.id).then(function (response) {

			arrRemove($scope.instances, instance);

		}, function (response) {
		}).finally(function () {

			loadingTop("pageBody", false);

		});

	};

	$scope.reset();

}]);


// $scope.reset = function(){
// 		$scope.instance = {
// 			'id' : null,
// 			'option_answer': {
// 				'option1': [{ 
// 					'answer': 'Poor',
// 				},{ 
// 					'answer': 'Fair',
// 				},{ 
// 					'answer': 'Good',
// 				},{ 
// 					'answer': 'Very good',
// 				}],
// 				'option2': [{ 
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
// 				'option3': [{ 
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
// 				'option4': [{ 
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
// 				}]
// 			}	
// 		};
// 	};