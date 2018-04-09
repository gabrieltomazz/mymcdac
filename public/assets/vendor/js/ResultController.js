app.controller("ResultController", ['$scope','$http','$window','$timeout', function ($scope, $http,$window,$timeout) {
	
	$scope.project;
  	$scope.listOfLevels = [];
  	$scope.optionAnswer;
  	$scope.count = 0;
  	$scope.listScaleResult;
  	$scope.loadingData = false;
  	$scope.showLeaf = true;
  	$scope.criterionIdsWithResults = [];
  	$scope.finalResult = [];
  	$scope.mainChartData = [[],[],[]];
	$scope.mainLabels = [];
	$scope.mainCriterian = [];
	$scope.mainChart2Data = [[],[]];
	$scope.labelChart2 = [];

	$scope.find = function(id){
	    loadingCenter("pageContent",true);
	    
	    $scope.findProject(id);
	    $scope.findOptionAnswer(id);
	    
	    $http.get('/criterions/find/'+id).then(function (response) {
			$scope.dataTree = response.data;
			$scope.findValues();
			
			for(var i in $scope.dataTree)
			{
				$scope.dataTree[i].scales = [];
				for(var a in $scope.optionAnswer){
					$scope.dataTree[i].scales.push(
					{
					    id: null,
					    n_id: $scope.count,
					    answer : $scope.optionAnswer[a].answer, 
					    value:null,
					    neutral: $scope.optionAnswer[a].neutral,
					    good : $scope.optionAnswer[a].good,
					    median : 0,
					    criterion_id: $scope.dataTree[i].id,
					    option_answer_id: $scope.optionAnswer[a].id,
					});
				}
				$scope.count++;   
			}

	    }, function (response) {
	    }).finally(function(){
	      loadingCenter("pageContent",false);
	    });
  	};

  	$scope.findProject = function(id){
		loadingCenter("pageContent",true);
		$http.get('/projects/find_project/'+id).then(function (response) {
			$scope.project = response.data[0];
		}, function (response) {
		}).finally(function(){
			loadingCenter("pageContent",false);
		});
 	};

 	$scope.findOptionAnswer = function(id){
	    loadingCenter("pageContent",true);
	    
	    $http.get('/projects/answers_by_project/'+id).then(function (response) {
	      $scope.optionAnswer = response.data;

	    }, function (response) {
	    }).finally(function(){
	      loadingCenter("pageContent",false);
	    });
  	};

  	$scope.findValues = function()
  	{
  		var listCriterionIds = [];
  		
  		for(var i in $scope.dataTree)
  		{
  			listCriterionIds.push({id: $scope.dataTree[i].id});
  		}

	  	loadingCenter("pageContent",true);
	    $http.post('/criterions/find_scale_result_by_criterion',listCriterionIds).then(function (response) {
	         $scope.listScaleResult = response.data;
	         $scope.fillDataWithResult();
	         //buildLevels($scope.dataTree);
	         
	    }, function (response) {
	    }).finally(function(){
	      loadingCenter("pageContent",false);
	    });	

  	};

  	$scope.fillDataWithResult = function()
	{
		for(var x in $scope.listScaleResult)
		{
			criterionData = findCriterionToFillResult($scope.listScaleResult[x][0].criterion_id);
			$scope.criterionIdsWithResults.push($scope.listScaleResult[x][0].criterion_id);
			for(var u in $scope.listScaleResult[x]) 
			{	
				criterionData.scales[u].id = $scope.listScaleResult[x][u].id;
				criterionData.scales[u].median = $scope.listScaleResult[x][u].median;
				criterionData.scales[u].value = $scope.listScaleResult[x][u].value;
				if(u == 0){
         			criterionData.performaceMin = $scope.listScaleResult[x][u].value; 
				}
				if($scope.listScaleResult[x][u].median == 1)
				{	
					criterionData.performaceMedia = $scope.listScaleResult[x][u].value;
				}
				if($scope.listScaleResult[x].length == parseFloat(u)+1)
				{
					criterionData.performaceMax = $scope.listScaleResult[x][u].value
				}
			}	
		}
		findDataWithoutResultAndFill($scope.criterionIdsWithResults);
		
	};

	var findCriterionToFillResult = function(criterion_id)
	{
		for(var i in $scope.dataTree)
		{
			if($scope.dataTree[i].id == criterion_id)
			{
				return $scope.dataTree[i];
			}
		}

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
		      }
		      
		    }
		}
		removeMainCriterian();
		buildChart();
		$scope.loadingData = true; 
	};

	var checkLevelCriterion = function(listCriterions,criterian){
    	var number = criterian.sequence.toString().length;
    	var titleLength = criterian.title.length;
		if(listCriterions.criterion.length == 0 ){
			 listCriterions.criterion.push({
			     step :number > 1 ? criterian.sequence.toString().substring(0,number-1) : number,
			     titleGroup : criterian.title.substring(0,titleLength-1),
			     level: listCriterions.level,
			     criteria: [criterian],
		     });
		}else{
		    for(var i in listCriterions.criterion){
		      if(listCriterions.criterion[i].step == criterian.sequence.toString().substring(0,number-1) ){
		        listCriterions.criterion[i].criteria.push(criterian);
		        return;
		      }
		    }

		    if(criterian.node.criterion_id != null){
			    mainCriterian = findCriterionToFillResult(criterian.node.id);
			    listCriterions.criterion.push({
					step :number > 1 ? criterian.sequence.toString().substring(0,number-1) : number,
					titleGroup : criterian.title.substring(0,titleLength-1),
					name : criterian.node.name,
					criterion_id : criterian.node.id,
					level: mainCriterian,
					criteria: [criterian],
			    });
			}      
		}
	};

	var findDataWithoutResultAndFill = function(criterionIdsWithResults)
	{
		listDataToFill = [];
		for(var i in $scope.dataTree)	
		{
			if(isIdInCriterionIdsWithResults(criterionIdsWithResults,$scope.dataTree[i].id))
			{
				listDataToFill.push($scope.dataTree[i]);
			}

		}

		fillDataAndCalculateResult(listDataToFill);
	};

	var isIdInCriterionIdsWithResults = function(criterionIdsWithResults, criterion_id)
	{
		for(var i in criterionIdsWithResults)
		{
			if(criterionIdsWithResults[i] == criterion_id)
			{
				return false;
			}
		} 
		return true;
	};

	var fillDataAndCalculateResult = function(listDataToFill)
	{
		while(listDataToFill.length != 0)
		{
			for( var i in listDataToFill)
			{	
				if(calculateResult(listDataToFill[i]))
				{
					arrRemove(listDataToFill ,listDataToFill[i]);
				}	
			}

		}
		calculeteFinalResult();
		buildLevels($scope.dataTree);	
	};

	var calculateResult = function(criterian)
	{
		criterions_son = getCriterionSons(criterian.id);
		if(isValidToCalculate(criterions_son))
		{
			return false;
		}

		for( var x in criterian.scales)
		{
			result = getCalculeScale(criterions_son,x);
			criterian.scales[x].value = result.value;
			if(x == 0)
			{
				criterian.performaceMin = criterian.scales[x].value;
				criterian.performaceMedia = result.median;
			}
			if(criterian.scales.length == parseFloat(x)+1)
			{
				criterian.performaceMax = criterian.scales[x].value;
			}
		}
		return true;
		
	};

	var getCriterionSons =  function(criterion_id)
	{
		criterionSons = [];
		for(var u in $scope.dataTree)
		{
			if($scope.dataTree[u].criterion_id == criterion_id)
			{
				criterionSons.push($scope.dataTree[u]);
			}
		}
		return criterionSons;

	};

	var getCalculeScale = function(criterions_son,x)
	{
		result = {value: 0,median: 0};
		
		for(var i in criterions_son)
		{
			result.value = result.value + (criterions_son[i].scales[x].value * criterions_son[i].percent);
			if(criterions_son[i].performaceMedia != null )
			{
				result.median = result.median + (criterions_son[i].performaceMedia * criterions_son[i].percent);
			} 
		}
		result.value = Math.round(result.value/100);
		result.median = Math.round(result.median/100);
		return result;

	}

	var isValidToCalculate = function(criterions_son)
	{
		for(var i in criterions_son)
		{
			for(var x in criterions_son[i].scales)
			{
				if(criterions_son[i].scales[x].value == null)
				{
					return true;
				}
			}
		}
		return false;
	}

	var removeMainCriterian = function()
	{
		for(var i in $scope.listOfLevels)
		{
			$scope.mainCriterian.push($scope.listOfLevels[i].criterion[0]);
			arrRemove($scope.listOfLevels[i].criterion ,$scope.listOfLevels[i].criterion[0]);
			
			if($scope.listOfLevels[i].criterion.length == 0)
			{
				$scope.showLeaf = false;
			}
		}

	}

	var calculeteFinalResult = function()
	{
		var mainCriterian = [];
		$scope.finalResult.scales = [];
		for(var a in $scope.optionAnswer){
			$scope.finalResult.scales.push(
			{
			    id: null,
			    n_id: $scope.count,
			    answer : $scope.optionAnswer[a].answer, 
			    value:null,
			    neutral: $scope.optionAnswer[a].neutral,
			    good : $scope.optionAnswer[a].good,
			    median : 0,
			    option_answer_id: $scope.optionAnswer[a].id,
			});
		}

		for(var i in $scope.dataTree)
		{
			if($scope.dataTree[i].criterion_id == null)
			{
				mainCriterian.push($scope.dataTree[i]);
			}
		}

		for( var x in $scope.finalResult.scales)
		{
			result = getCalculeScale(mainCriterian,x);
			$scope.finalResult.scales[x].value = result.value;
			if(x == 0)
			{
				$scope.finalResult.performaceMin = $scope.finalResult.scales[x].value;
				$scope.finalResult.performaceMedia = result.median;
			}
			if($scope.finalResult.scales.length == parseFloat(x)+1)
			{
				$scope.finalResult.performaceMax = $scope.finalResult.scales[x].value;
			}
		}

		for(var u in mainCriterian)
		{
			$scope.mainChartData[0].push(mainCriterian[u].performaceMax);
			$scope.mainChartData[1].push(mainCriterian[u].performaceMedia);
			$scope.mainChartData[2].push(mainCriterian[u].performaceMin);
			$scope.mainLabels.push([mainCriterian[u].performaceMax,mainCriterian[u].performaceMedia,mainCriterian[u].performaceMin]);
			
			calcChart2 = ((mainCriterian[u].performaceMedia+Math.abs(mainCriterian[u].performaceMin))/(Math.abs(mainCriterian[u].performaceMin)+mainCriterian[u].performaceMax +1))*100;
			$scope.mainChart2Data[0].push(100);
			$scope.mainChart2Data[1].push(Math.round(calcChart2,4));
			$scope.labelChart2.push(mainCriterian[u].name);	
		}

		$scope.mainChartData[0].push($scope.finalResult.performaceMax);
		$scope.mainChartData[1].push($scope.finalResult.performaceMedia);
		$scope.mainChartData[2].push($scope.finalResult.performaceMin);

		calcChart2Total = (($scope.finalResult.performaceMedia + Math.abs($scope.finalResult.performaceMin))/(Math.abs($scope.finalResult.performaceMin) + $scope.finalResult.performaceMax + 1))*100;
		$scope.mainChart2Data[0].push(100);
		$scope.mainChart2Data[1].push(Math.round(calcChart2Total,4));
		$scope.labelChart2.push("Total");	

		$scope.mainLabels.push(['Total',$scope.finalResult.performaceMax,$scope.finalResult.performaceMedia,$scope.finalResult.performaceMin])


	}
	var buildChart = function()
	{
		for(var i in $scope.mainCriterian)
		{
			$scope.mainCriterian[i].data = [[],[],[]];
			$scope.mainCriterian[i].labels = [];
			$scope.mainCriterian[i].series = [];
			  
			for(var u in $scope.mainCriterian[i].criteria)
			{
				$scope.mainCriterian[i].data[0].push($scope.mainCriterian[i].criteria[u].performaceMax);
				$scope.mainCriterian[i].data[1].push($scope.mainCriterian[i].criteria[u].performaceMedia);
				$scope.mainCriterian[i].data[2].push($scope.mainCriterian[i].criteria[u].performaceMin);
				$scope.mainCriterian[i].labels.push([$scope.mainCriterian[i].criteria[u].performaceMax,$scope.mainCriterian[i].criteria[u].performaceMedia,$scope.mainCriterian[i].criteria[u].performaceMin]);
				//$scope.mainCriterian[i].series.push($scope.mainCriterian[i].criteria[u].name);
			}
			$scope.mainCriterian[i].data[0].push($scope.mainCriterian[i].level.performaceMax);
			$scope.mainCriterian[i].data[1].push($scope.mainCriterian[i].level.performaceMedia);
			$scope.mainCriterian[i].data[2].push($scope.mainCriterian[i].level.performaceMin);
			$scope.mainCriterian[i].labels.push(["Total",$scope.mainCriterian[i].level.performaceMax,$scope.mainCriterian[i].level.performaceMedia,$scope.mainCriterian[i].level.performaceMin])
			//$scope.mainCriterian[i].series.push("Total");
		}
	}

	// Charts 1
	//$scope.labels = [['Metrô',189,65,-89],['Onibus',152,70,-52],['Micro - onibus',128,77,-28],['Total',161,69,-61]];

	
	
	//$scope.data = [[189,152,128,161],[65,70,77,69],[-89,-52,-28,-61]];
	
	$scope.onClick = function (points, evt) {
		console.log(points, evt);
	};
	$scope.datasetOverride = [{ yAxisID: 'y-axis-1' }];

	$scope.options = {
		scales: {	
		  yAxes: [
		    {
		      id: 'y-axis-1',
		      type: 'linear',
		      display: true,
		      position: 'left'
		    }
		  ]
		}
	};
	// chart 2
	  
  	$scope.serie = ['Series A', 'Series B'];
	$scope.optionsChart2 = {
		scales: {
		    yAxes: [{
                ticks: {
                    beginAtZero:true
                }
        	}]
		}
	};
	 

}]);
