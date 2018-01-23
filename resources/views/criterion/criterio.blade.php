

<!-- Nested node template -->

<div ng-controller="BasicExampleCtrl" ng-init="find({{$id}})" >
	<script type="text/ng-template" id="nodes_renderer.html">
	  <div ui-tree-handle class="tree-node tree-node-content">
	    <a class="btn btn-success btn-xs" ng-if="node.nodes && node.nodes.length > 0" data-nodrag ng-click="toggle(this)"><span
	        class="glyphicon"
	        ng-class="{
	          'glyphicon-chevron-right': collapsed,
	          'glyphicon-chevron-down': !collapsed
	        }"></span></a>
	     	<span ng-if ="node.name == null ">@{{node.title}}.</span> 
	     	<span ng-if ="node.name != null ">@{{node.title}}. @{{node.name}}  @{{node.percent}}% </span> 
	     	
          	  
	    
	    <a class="pull-right btn btn-danger btn-xs" data-nodrag ng-click="excluir(this)"><span
	        class="glyphicon glyphicon-remove"></span></a>
	    <a class="pull-right btn btn-info btn-xs" data-nodrag data-toggle="modal" data-target="#myModal" ng-click="findNode(node.title)" style="margin-right: 8px;"><span
	        class="glyphicon glyphicon-edit"></span></a>     
	    <a class="pull-right btn btn-primary btn-xs" data-nodrag ng-click="newSubItem(this)" style="margin-right: 8px;"><span
	        class="glyphicon glyphicon-plus"></span></a> 
	  </div>
	  <ol ui-tree-nodes="" ng-model="node.nodes" ng-class="{hidden: collapsed}">
	    <li ng-repeat="node in node.nodes" ui-tree-node ng-include="'nodes_renderer.html'">
	    </li>
	  </ol>
	</script>
	<div class = "container">
	    <div class = "panel panel-default">
	    	<div class = "container">
				<div class="row">
				  <div class="col-sm-12">
				    <h3> Criterian Table</h3>
				    <button type="button" class="btn btn-default" ng-click="newItem({{$id}})">New Criteria</button>
				    <button ng-click="expandAll()">Expand all</button>
				    <button ng-click="collapseAll()">Collapse all</button>
				  </div>
				</div>
			
				<div class="row">
					<div class="col-sm-8">
					    <div ui-tree id="tree-root">
					      <div class="form-group">
						      <ol ui-tree-nodes ng-model="data">
						        <li ng-repeat="node in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
						      </ol>
						  </div>	    
					    </div>
				  	</div>
					<!-- <div class="col-sm-6">
					    <div class="info">
					      @{{info}}
					    </div>
					    <pre class="code">@{{ data | json }}</pre>
				  	</div> -->
				</div>
			</div>		  
		</div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title" ng-if ="nodeSelecionado.name == null">@{{nodeSelecionado.title}}</h4> -->
          <h4 class="modal-title">@{{nodeSelecionado.name}} - @{{nodeSelecionado.title}}</h4>     
          	
        </div>
        <div class="modal-body">
	        <div class="form-horizontal" >
		        <div class="form-group">	
		        	<div class = "col-md-8">
						<div class = "form-group-sm" >
			                <label for = "name">Criterion Name: </label>
			                <input class = "form-control" type = "text" id = "name" ng-model = "nodeSelecionado.name">
			           	</div>
					</div>
				</div>	
				<div class="form-group">
					<div class = "col-md-2">
						<div class = "form-group-sm">
		                    <label for = "name">Percent(%)</label>
		                    <input class = "form-control" type = "number" id = "name" ng-model = "nodeSelecionado.percent">
		               	</div>
					</div>
				</div>
			</div>	
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveNodeSelecionado(nodeSelecionado)">Save</button>
        </div>
      </div>
      
    </div>
  </div>




</div>	




