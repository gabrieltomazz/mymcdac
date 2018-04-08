app.controller("CriterionController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {

	$scope.instances = [];
	$scope.project;
  $scope.listOfLevels = [];
  $scope.effortNumber;
  $scope.contribution;

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
      var list_sequences = [];
      for(var i in criterions){
        if(criterions[i].criterion_id == null ){
          list_sequences.push({
            sequence :criterions[i].sequence,
            sequences: [],
          });
          
          $scope.listOfLevels.push({
            level :criterions[i],
            criterion: [],
          });
        }
      }
      for(var u in list_sequences){
        for(var v in criterions ){
          var one = String(criterions[v].sequence).charAt(0);
          if(list_sequences[u].sequence == one){
            list_sequences[u].sequences.push(criterions[v].sequence);

          }
        }
      }
      for(var u in list_sequences){
        for(var v in criterions ){
          var one = String(criterions[v].sequence).charAt(0);
          if(list_sequences[u].sequence == one & criterions[v].criterion_id != null ){
            checkLevelCriterion($scope.listOfLevels[u],criterions[v]);
            //$scope.listOfLevels[u].criterion.push(criterions[v]);
          }
          
        }
      }
  

  };

  var checkLevelCriterion = function(listCriterions,criterian){
      var number = criterian.sequence.toString().length;
      var titleLength = criterian.title.length;
      if(listCriterions.criterion.length == 0 ){
        listCriterions.criterion.push({
            step :number > 1 ? criterian.sequence.toString().substring(0,number-1) : number,
            titleGroup : criterian.title.substring(0,titleLength-1),
            criteria: [criterian],
          });
      }else{
        for(var i in listCriterions.criterion){
          if(listCriterions.criterion[i].step == criterian.sequence.toString().substring(0,number-1) ){
            listCriterions.criterion[i].criteria.push(criterian);
            return;
          }
        }
        listCriterions.criterion.push({
              step :number > 1 ? criterian.sequence.toString().substring(0,number-1) : number,
              titleGroup : criterian.title.substring(0,titleLength-1),
              criteria: [criterian],
            });
         
      }
  }; 

  $scope.saveEffort = function(effort){
    effort,$scope.effortNumber;

  };

  $scope.saveContributionRateOrEffortGeneral = function(contribution,type){
    
    if(type == 'rate'){
      var totalContribution = 0 ;
      for(var i in contribution){
        totalContribution = totalContribution + contribution[i].level.percent;
      }
      if(totalContribution > 100 || totalContribution < 100 ){
        confirm("Contribution rate should be 100% ")
        return;
      }
    }
      
    for(var i in contribution){
      loadingCenter("pageContent",true);
      //$scope.instance.project_id =1;

      $http.post("/criterions/store",contribution[i].level).then(function (response) {


      }, function (response) {
      }).finally(function(){
        loadingCenter("pageContent",false);
      });
    }
    appInfo("Successfully save!");
  };


  $scope.saveContributionRateOrEffort = function(contribution,type){
      
    if(type == 'rate'){
      var totalContribution = 0 ;

      for(var i in contribution.criteria){
        totalContribution = totalContribution + contribution.criteria[i].percent;
      }
      if(totalContribution > 100 || totalContribution < 100 ){
        confirm("Contribution rate should be 100% ")
        return;
      }
    }    
    for(var i in contribution.criteria){
      loadingCenter("pageContent",true);
      //$scope.instance.project_id =1;

      $http.post("/criterions/store",contribution.criteria[i]).then(function (response) {

      }, function (response) {
      }).finally(function(){
        loadingCenter("pageContent",false);
      });
    }
    appInfo("Successfully save!");
  };

  $scope.isValidContributionRate =  function(id)
  {
    for(var i in $scope.dataTree)
    {
        if($scope.dataTree[i].percent == null)
        {
          alert("Please insert percent in criterian: "+$scope.dataTree[i].name+" and Save ");
          return;
        }
    }
    $window.location.href = '/projects/'+id+'/order_criterio';

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



	// // Charts 1
	// $scope.labels = ["1.1", "1.2", "1.3"];
	// $scope.series = ['Series A', 'Series B', 'Series C'];
	// $scope.data = [
	// 	[170, 100, -66],
	// 	[100, 120, -20],
	// 	[-66, -20, -22]
	// ];
 //  $scope.onClick = function (points, evt) {
 //    console.log(points, evt);
 //  };
 //  $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
  
 //  $scope.options = {
 //    scales: {
 //      yAxes: [
 //        {
 //          id: 'y-axis-1',
 //          type: 'linear',
 //          display: true,
 //          position: 'left'
 //        },
 //        {
 //          id: 'y-axis-2',
 //          type: 'linear',
 //          display: true,
 //          position: 'right'
 //        }
 //      ]
 //    }
 //  };
 //  // chart 2
 //  $scope.label = ['2006', '2007', '2008', '2009', '2010', '2011', '2012'];
 //  $scope.serie = ['Series A', 'Series B'];

 //  $scope.datas = [
 //    [65, 59, 80, 81, 56, 55, 40],
 //    [28, 48, 40, 19, 86, 27, 90]
 //  ];

}]);