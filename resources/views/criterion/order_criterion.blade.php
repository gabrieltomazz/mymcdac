@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')">
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
</div>

<!-- Nested node template -->

<div ng-controller="ScaleController" ng-init="findOrder({{$id}})" >
	<script type="text/ng-template" id="nodes_renderer.html">
		<div ui-tree-handle class="tree-node tree-node-content">
			<span >@{{node.title}}. @{{node.name}}</span> 
		</div>
	</script>

	<div class = "container">
	    <div class = "panel panel-default">
	    	<div class = "container">
				<div class="row">
				  <div class="col-sm-12">
				    <h3> Sort the criteria by Effort level </h3>
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
				</div>
			</div>		  
		</div>
		<div class="panel-footer">
			<div class="col-md-6">
				<a type="button" class="btn btn-danger"  href = "/projects/{{$id}}/criterio/effort_level">Back - Effort level</a>
			</div>
			<div class="col-md-6">
				<a type="button" class="btn btn-success  pull-right" ng-click="saveSort({{$id}})">Next - Median Scale</a>
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




@endsection