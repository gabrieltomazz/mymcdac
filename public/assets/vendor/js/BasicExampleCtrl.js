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
        $scope.nodeSelecionado = nodeData[node-1];
      };

      $scope.newSubItem = function (nodeData) {
        if(nodeData.nodes == null){
          nodeData.nodes = [];
        }
        var node = nodeData.nodes.push({
          id:null,
          sequence: nodeData.sequence * 10 + (nodeData.nodes.length+1),
          title: nodeData.title + '.' + (nodeData.nodes.length + 1),
          name: null,
          nodrop: true, 
          nodes: [],
          project_id: nodeData.project_id,
          criterion_id: nodeData.id ,
        });
        $scope.nodeSelecionado = nodeData.nodes[node-1];
      };

      $scope.collapseAll = function () {
        $scope.$broadcast('angular-ui-tree:collapse-all');
      };

      $scope.expandAll = function () {
        $scope.$broadcast('angular-ui-tree:expand-all');
      };
      
      $scope.animationsEnabled = true;

      $scope.findNode =  function(node){
          $scope.nodeSelecionado = node
      };

      $scope.saveNodeSelecionado = function(saveNode){
          $scope.save(saveNode);
      };
      $scope.save = function(node){

        loadingCenter("pageContent",true);
        //$scope.instance.project_id =1;
        $scope.data;
        $http.post("/criterions/store",node).then(function (response) {

          appInfo("Registro salvo com sucesso!");
          // $scope.data[i].id = response.data.id ;
          $scope.nodeSelecionado.id = response.data.id ;
          //location.reload();

        }, function (response) {
        }).finally(function(){
          loadingCenter("pageContent",false);
        });
      };

    $scope.data = [];

    }]);

}());