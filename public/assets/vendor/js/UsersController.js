app.controller("UsersController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

$scope.users;

	$scope.buildUser = function(user){

		$scope.users= user;

	};


	$scope.update = function(id){
			
			$http.post("/update",$scope.users).then(function (response) {

				appInfo("Update successfully");

				$scope.users = response.data;
				
				$window.location.href = '/projects';

			}, function (response) {
			}).finally(function(){
				loadingCenter("pageContent",false);
			});


	};
	

}]);