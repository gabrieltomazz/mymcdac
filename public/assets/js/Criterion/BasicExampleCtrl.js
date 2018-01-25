(function () {
  'use strict';

    app.controller('BasicExampleCtrl', ['$scope','$http', function ($scope,$http,$uibModal) {
      $scope.project_id; 
      $scope.nodeSelecionado;
      $scope.instances;
      $scope.dataTree;
      $scope.lastNodes;
      
      $scope.excluir = function (scope) {
          
          if (!confirm("Confirma a exclusão deste registro?"))
          return;

          if(scope.$modelValue.id == null){
            scope.remove();
            return;
          }
          loadingTop("pageBody", true);

          $http.get('/criterions/remove/' + scope.$modelValue.id).then(function (response) {
            scope.remove();
            //arrRemove($scope.instances, instance);

          }, function (response) {
          }).finally(function () {

            loadingTop("pageBody", false);

          });

      };

      $scope.toggle = function (scope) {
        scope.toggle();
      };

      $scope.moveLastToTheBeginning = function () {
        var a = $scope.data.pop();
        $scope.data.splice(0, 0, a);
      };
      
      $scope.find = function(id){

        loadingCenter("pageContent",true);
        //id=1
        $http.get('/criterions/find/'+id).then(function (response) {
          $scope.dataTree = response.data;
          list_to_tree(response.data);

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
                  list[map[node.criterion_id]].nodes.push(node);
              } else {
                  roots.push(node);
              }
          }
          return $scope.data = roots;
      };

      $scope.findTree = function(id){

        loadingCenter("pageContent",true);
        $http.get('/criterions/find/'+id).then(function (response) {
          $scope.lastNodes = response.data;

        }, function (response) {
        }).finally(function(){
          loadingCenter("pageContent",false);
        });
      };

      $scope.newItem = function (project_id) {
        var nodeData = $scope.data;
        var node = nodeData.push({
          id:null,
          sequence: nodeData.length + 1,
          title: (nodeData.length + 1),
          nodes: [],
          project_id: project_id,
          criterion_id:null,
        });
      };

      $scope.newSubItem = function (scope) {
        var nodeData = scope.$modelValue;
        if(nodeData.nodes == null){
          nodeData.nodes = [];
        }
        nodeData.nodes.push({
          id:null,
          sequence: nodeData.sequence * 10 + (nodeData.nodes.length+1),
          title: nodeData.title + '.' + (nodeData.nodes.length + 1),
          name: null,
          nodrop: true, 
          nodes: [],
          project_id: nodeData.project_id,
          criterion_id: nodeData.id ,
        });
      };

      $scope.collapseAll = function () {
        $scope.$broadcast('angular-ui-tree:collapse-all');
      };

      $scope.expandAll = function () {
        $scope.$broadcast('angular-ui-tree:expand-all');
      };
      
      $scope.animationsEnabled = true;

      $scope.findNode =  function(title){
          for (var i in $scope.data){
          if($scope.data[i].title == title){

            $scope.nodeSelecionado = $scope.data[i];
          }else{
              findNodes($scope.data[i].nodes,title);
          }
        }
      };

      var findNodes = function(data,title){

        for (var i in data){
          if(data[i].title == title){
            $scope.nodeSelecionado =data[i];
          }else{
            findNodes(data[i].nodes,title);
          }
          
        }
      };

      var findNodesSave =  function(data,title){
          for (var i in data){
            if(data[i].title == title){
                data[i].name = $scope.nodeSelecionado.name;
                data[i].percent = $scope.nodeSelecionado.percent;
                $scope.save(data[i],i);
                
            }else{
                findNodesSave(data[i].nodes,title);
            }
        }
      };

      $scope.saveNodeSelecionado = function(saveNode){
          findNodesSave($scope.data,saveNode.title);
      };
      $scope.save = function(node,i){

        loadingCenter("pageContent",true);
        //$scope.instance.project_id =1;

        $http.post("/criterions/store",node).then(function (response) {

          appInfo("Registro salvo com sucesso!");
          response.data.id = $scope.data[i].id;
          //location.reload();

        }, function (response) {
        }).finally(function(){
          loadingCenter("pageContent",false);
        });
      };

    $scope.data = [];

    }]);

}());