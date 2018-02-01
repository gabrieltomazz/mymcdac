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
			'option_answer': [{
			}]	
		};
	};

	$scope.addOp = function(){
		$scope.instance.option_answer.push({});

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
		prepareToSaveOptionsAnswer($scope.instance.option_answer);

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
	var prepareToSaveOptionsAnswer = function(options){

		for(var i in options){
			if(options[i].id == null){
				$scope.instance.option_answer[i].id = null;
			}
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