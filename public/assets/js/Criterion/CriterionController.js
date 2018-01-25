app.controller("CriterionController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

	$scope.instances = [];
	$scope.project;
  $scope.listOfLevels = [];


	$scope.find = function(id){

        loadingCenter("pageContent",true);
        $scope.findProject(id);
        $http.get('/criterions/find/'+id).then(function (response) {
          $scope.dataTree = response.data;
          buildLevels(response.data);

        }, function (response) {
        }).finally(function(){
          loadingCenter("pageContent",false);
        });
  };

  $scope.findProject = function(id){

      loadingCenter("pageContent",true);
      $http.get('/projects/find_project/'+id).then(function (response) {
        $scope.project = response.data;

      }, function (response) {
      }).finally(function(){
        loadingCenter("pageContent",false);
      });
  };

  var buildLevels = function(criterions){
      for(var i in criterions){
        var step = checkLevelCriterion(criterions[i]);

        if(checkIfLevelExist(step)){
          createLevel(step);
          insertCriterioOnList(step,criterions[i]);
        }else{
          insertCriterioOnList(step,criterions[i]);
        }

      } 
  };
  var checkLevelCriterion = function(criterian){
      //var level;  
      if(criterian.title.length == 1 ){
        return 1;
      }
      if(criterian.title.length == 3 ){
        return 2;
      }
      if(criterian.title.length == 5 ){
        return 3;
      }
      if(criterian.title.length == 7 ){
        return 4;
      }
      if(criterian.title.length == 9 ){
        return 5;
      }    
  }; 

  var checkIfLevelExist =  function(step){
    
    if($scope.listOfLevels.length > 0 ){
      for(var i in $scope.listOfLevels){
        if($scope.listOfLevels[i].level == step){
          return false;
        }
      }
      return true;
    }
    return true;
  };

  var createLevel =  function(step){
    $scope.listOfLevels.push({
          level :step,
          criterions: [],
        });
  };

  var insertCriterioOnList = function(step,criterian){
    for(var i in $scope.listOfLevels){
        if($scope.listOfLevels[i].level == step){
          $scope.listOfLevels[i].criterions.push(criterian);
        }
      }
  };

	// Charts 1
	$scope.labels = ["1.1", "1.2", "1.3"];
	$scope.series = ['Series A', 'Series B', 'Series C'];
	$scope.data = [
		[170, 100, -66],
		[100, 120, -20],
		[-66, -20, -22]
	];
  $scope.onClick = function (points, evt) {
    console.log(points, evt);
  };
  $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
  
  $scope.options = {
    scales: {
      yAxes: [
        {
          id: 'y-axis-1',
          type: 'linear',
          display: true,
          position: 'left'
        },
        {
          id: 'y-axis-2',
          type: 'linear',
          display: true,
          position: 'right'
        }
      ]
    }
  };
  // chart 2
  $scope.label = ['2006', '2007', '2008', '2009', '2010', '2011', '2012'];
  $scope.serie = ['Series A', 'Series B'];

  $scope.datas = [
    [65, 59, 80, 81, 56, 55, 40],
    [28, 48, 40, 19, 86, 27, 90]
  ];

}]);