app.controller("ProjectController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

	$scope.instance;
	$scope.filtros = {
		'filtros': {
			'limit': 100
		}
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
					'answer': null,
				}]
			}	
		};
	};

	$scope.addOp = function(){
		$scope.instance.option_answer.others.push({});

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
			response.data.option_answer = $scope.instance.option_answer;
			$scope.instance = response.data;

		}, function (response) {
			console.log('erro');
		}).finally(function(){
			loadingCenter("pageContent",false);
		});

	};

	$scope.store = function(id){
		
		$scope.instance.user_id = id ;
		loadingCenter("pageContent",true);
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
	
	$scope.deleteOption = function(scope){

		if(scope.option.id == null){
        	for(var i in $scope.instance.option_answer['others']){
            	if($scope.instance.option_answer['others'][i].answer == scope.option.answer){
            		//$scope.instance.option_answer[$scope.instance.option][i].splice();
            		arrRemove($scope.instance.option_answer['others'],$scope.instance.option_answer['others'][i]);
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