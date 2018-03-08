@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')">
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
</div>

<!-- Nested node template -->

<div ng-controller="BasicExampleCtrl" ng-init="find({{$id}})" >
	<script type="text/ng-template" id="nodes_renderer.html">
	  <div ui-tree-handle data-nodrag class="tree-node tree-node-content">
	    <a class="btn btn-success btn-xs" ng-if="node.nodes && node.nodes.length > 0" data-nodrag ng-click="toggle(this)"><span
	        class="glyphicon"
	        ng-class="{
	          'glyphicon-chevron-right': collapsed,
	          'glyphicon-chevron-down': !collapsed
	        }"></span></a>
	     	<span ng-if ="node.percent == null ">@{{node.title}}. @{{node.name}}</span> 
	     	<span ng-if ="node.percent != null ">@{{node.title}}. @{{node.name}} @{{node.percent}}% </span> 
	     	
          	  
	    
	    <a class="pull-right btn btn-danger btn-xs" data-nodrag ng-click="excluir(this)"><span
	        class="glyphicon glyphicon-remove"></span></a>
	    <a class="pull-right btn btn-info btn-xs" data-nodrag data-toggle="modal" data-target="#myModal" ng-click="findNode(node)" style="margin-right: 8px;"><span
	        class="glyphicon glyphicon-edit"></span></a>     
	    <a class="pull-right btn btn-primary btn-xs" data-nodrag data-toggle="modal" data-target="#myModal" ng-click="newSubItem(node)"  style="margin-right: 8px;"><span
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
				    <h3> Criterian Tree</h3>
				    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" ng-click="newItem({{$id}})" >New Criteria</button>
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
		<div class="panel-footer">
			<a type="button" class="btn btn-success"  href = "/projects/{{$id}}/criterio/contribution_rate">Next - Contribution rate {{$id}}</a>
		</div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <!-- <h4 class="modal-title" ng-if ="nodeSelecionado.name == null">@{{nodeSelecionado.title}}</h4> -->
	          <h4 class="modal-title" ng-show="nodeSelecionado.name != null ">@{{nodeSelecionado.name}} - @{{nodeSelecionado.title}}</h4>     
	          	
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
					<!-- <div>
						<label> The contribuittion rate, shows, in percent, what is the criterian importante...</label>
						<label for = "name">Contribuition Rate: </label>
					</div>	
					<div class="form-group">
						<div class = "form-group-sm">
							<div class="col-md-2">
			                    <input class = "form-control" type = "number" id = "name" min="0" max="99" ng-model = "nodeSelecionado.percent" required="" autofocus>
			               	</div>
						</div>
					</div> -->
				</div>	
	        </div>

	        <div class="modal-footer">
	          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="save(nodeSelecionado)">Save</button>
	        </div>
	      </div>
	      
	    </div>
  	</div>

</div>	




@endsection