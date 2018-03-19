app.controller("ScaleController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout,$uibModal) {

$scope.criterions;
$scope.dataFindOrder;
$scope.answer;
$scope.count = 1;

$scope.data = [];

  $scope.findOrder = function(id){

    loadingCenter("pageContent",true);
   
    $http.get('/criterions/find_order/'+id).then(function (response) {
       
      if(response.data.length > 0){
        $scope.dataFindOrder = response.data;
        $scope.data = $scope.dataFindOrder;
      }else{
        $scope.findCriterian(id);
      } 
      
       
    }, function (response) {
    }).finally(function(){
      loadingCenter("pageContent",false);
    });
  };


  $scope.findOrderProject = function(id){
    $scope.findAnswer(id);
    
    loadingCenter("pageContent",true);
   
    $http.get('/criterions/find_order_project/'+id).then(function (response) {

        $scope.data = response.data;

        for(var i in $scope.data)
        {
          $scope.data[i].scales = [];
          for(var a in $scope.answer){
            $scope.data[i].scales.push(
              {
                answer : $scope.answer[a].answer, 
                value:null,
                neutral: $scope.answer[a].neutral,
                good : $scope.answer[a].good,
                median : null,
              }
            );
          }
              
        }

        for(var x in $scope.data)
        {
          for(var u in $scope.data[x].scales)
          {
            if($scope.data[x].scales[u].neutral == 1)
            {
              $scope.data[x].scales[u].value = 0;
              setNegativeValues(x,u);
          
            }else if($scope.data[x].scales[u].good == 1)
            {
              $scope.data[x].scales[u].value = 100;
              setPositiveValues(x,u)
            }
          }
        }
       
    }, function (response) {
    }).finally(function(){
      loadingCenter("pageContent",false);
    });
  };

  var setNegativeValues = function(position_data,position_scale)
  {
    var i = 0;
    while(i != position_scale)
    {
      if( i == 0 )
      {
        $scope.data[position_data].scales[i].value = 0 - ($scope.data[position_data].project.steps)*($scope.data.length - position_data); 
      }else
      {
        $scope.data[position_data].scales[i].value = 0 - ((($scope.data[position_data].project.steps)*($scope.data.length- position_data))/position_scale);
      }
      
      i++
    }
  }

  var setPositiveValues = function(position_data,position_scale)
  {
    var i = $scope.data[position_data].scales.length -1;
    while(i != position_scale )
    {
      if( i == $scope.data[position_data].scales.length -1)
      {
        $scope.data[position_data].scales[i].value = 100 + ($scope.data[position_data].project.steps)*($scope.data.length - position_data); 
      }else
      {
        $scope.data[position_data].scales[i].value = 100 + ((($scope.data[position_data].project.steps)*($scope.data.length - position_data))/position_scale);
      }
      
      i--
    }
  }

  $scope.findCriterian = function(id){

    loadingCenter("pageContent",true);
   
    $http.get('/criterions/find/'+id).then(function (response) {
       list_to_tree(response.data);
       //lastNode(response.data);
    }, function (response) {
    }).finally(function(){
      loadingCenter("pageContent",false);
    });
  };

  $scope.toggle = function (scope) {
    scope.toggle();
  };

  $scope.moveLastToTheBeginning = function () {
    var a = $scope.data.pop();
    $scope.data.splice(0, 0, a);
  };

  $scope.saveSort = function(id){

      if($scope.dataFindOrder ==  undefined ){
        for(var i in $scope.data){
          $scope.data[i].order = parseFloat(i)+1;
          $scope.data[i].criterion_id = $scope.data[i].id;
        }
      }else{
        for(var i in $scope.data){
          $scope.data[i].order = parseFloat(i)+1;
        }
      }

      $http.post("/criterions/save_order",$scope.data).then(function (response) {

        $window.location.href = '/projects/'+id+'/criterio/median_scale';

      }, function (response) {
      }).finally(function(){
        loadingCenter("pageContent",false);
      });

  };

  $scope.findAnswer = function(id){

      loadingCenter("pageContent",true);
      $http.get('/projects/answers_by_project/'+id).then(function (response) {
        
        $scope.answer = response.data;
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
              //list[map[node.criterion_id]].nodes[node.effort] = node;
              list[map[node.criterion_id]].nodes.push(node);
          } else {
              roots.push(node);
              //roots.splice(node.effort, 0 , node);

          }
      }
      return lastNode(roots); 
  };

  var lastNode = function(data){
      for(var i in data){
          if(data[i].nodes.length > 0 ){
            lastNode(data[i].nodes);
          }else{
            $scope.data.push(data[i]);    
        
          }
      }
      
  };
}]);