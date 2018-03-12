app.controller("ScaleController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

$scope.criterions = [];
$scope.project;
$scope.count = 1;

$scope.findCriterian = function(id){

  loadingCenter("pageContent",true);
  $scope.findProject(id);
  
  $http.get('/criterions/find/'+id).then(function (response) {
     //list_to_tree(response.data);
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

var list_to_tree = function(list) {
    var map = {}, node, roots = [] ,i;
    for (i = 0; i < list.length; i += 1) {
        map[list[i].id] = i; // initialize the map
        list[i].nodes = []; // initialize the children
    }
    for (i = 0; i < list.length; i += 1) {
        node = list[i];
        if (node.criterion_id !== null) {
            // if you have dangling branches check that map[node.parentId] exists
            //list[map[node.criterion_id]].nodes.splice(node.effort,0,node);
            list[map[node.criterion_id]].nodes[node.effort] = node;
            //array.splice( insertAtIndex, 0, stringToBeInserted );
        } else {
            roots.splice(node.effort, 0 , node);

        }
    }
    return $scope.criterions = roots; 
};

var lastNode = function(data){
    for(var i in data){
        if(data[i].node != null){
          $scope.criterions.push(data[i]);    
      
        }
    }
    for(var i in $scope.criterions){
        $scope.criterions[i].scales = $scope.project;
    }

    for(var i in $scope.criterions){
        for(var u in $scope.criterions[i].scales){
          var j = parseFloat(u)+1;
          if ($scope.criterions[i].scales[u].good == 1 ){
              $scope.criterions[i].scales[u].value = 100;
          }else if($scope.criterions[i].scales[u].neutral == 1){
              $scope.criterions[i].scales[u].value = 0;
          }else if($scope.criterions[i].scales[j].neutral != undefined && $scope.criterions[i].scales[j].neutral == 1){
              $scope.criterions[i].scales[u].value = -($scope.criterions.length*$scope.criterions[i].scales[u].steps);
          }else if($scope.criterions[i].scales[j-2].good != undefined && $scope.criterions[i].scales[j-2].good == 1){
             $scope.criterions[i].scales[u].value = 100+($scope.criterions.length*$scope.criterions[i].scales[u].steps)-$scope.criterions[i].scales[u].steps;
          }else{
            $scope.criterions[i].scales[u].value = 100+($scope.criterions.length*$scope.criterions[i].scales[u].steps);
          }

      }
    }

};
// if(data.length >= $scope.count ){
    //       if(data[i].effort == $scope.count){
    //         if(data[i].length == 0){
    //           $scope.criterions.push(data[i]);
    //           $scope.count = $scope.count+1;
    //         }else{
    //           lastNode(data[i].nodes);
    //         }
    //       }
}]);