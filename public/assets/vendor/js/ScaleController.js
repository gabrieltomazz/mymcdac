app.controller("ScaleController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

$scope.criterions = [];
$scope.project;


$scope.findCriterian = function(id){

  loadingCenter("pageContent",true);
  $scope.findProject(id);
  
  $http.get('/criterions/find/'+id).then(function (response) {
     lastNode(response.data);

  }, function (response) {
  }).finally(function(){
    loadingCenter("pageContent",false);
  });
};

$scope.findProject = function(id){

    loadingCenter("pageContent",true);
    $http.get('/projects/answers_by_project/'+id).then(function (response) {
      $scope.project = response.data;

    }, function (response) {
    }).finally(function(){
      loadingCenter("pageContent",false);
    });
};

var lastNode = function(data){

    for(var i in data){
      if(data[i].node != null){
        $scope.criterions.push(data[i]);
      }
    }
}



}]);