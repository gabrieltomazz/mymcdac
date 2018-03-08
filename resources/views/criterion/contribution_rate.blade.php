@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')">
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
</div>

<div class="container" ng-controller="CriterionController" ng-init="find({{$id}})">
	<div class="container" >
		<h3> Contribution Rate</h3>
	</div>
	<div >
		<!-- ng-repeat = "nos in listOfLevels track by $index" -->
		<div class="col-md-6" style="width: 800px;">
			<div class = "box box-success">
		        <div class = "box-header with-border">
		            <div class="col-md-4">
		            	<h3 class = "box-title"> General Criteria</h3>
		        	</div>
					<div class="text-right">
          				<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveContributionRateOrEffortGeneral(listOfLevels,'rate')" >Save</button>
        			</div>		        
		        </div>
		        <div class = "box-body ">
		            <table class="table table-striped table-bordered table-hover table-sm">
						<thead >
						    <tr class="bg-primary">
						      <th class="col-md-4">Criterian Name </th>
						      <th class="col-md-1">Percent(%) </th>
						    </tr>
						</thead>
				  		<tbody >
						    <tr  ng-repeat = "no in listOfLevels">
						    	<td>	
									@{{no.level.title}} - @{{no.level.name}}
						    	</td>
						    	<td >
						    		<div class="col-md-10">
						    			<input class = "form-control" type = "number" min="0" id = "name" ng-model = "no.level.percent">
						    		</div>
						    	</td>		
						    </tr>
					  	</tbody>
					</table>
		        </div>
	        </div>    
	    </div>
	</div>

	<div class="col-md-12" ng-repeat = "nos in listOfLevels track by $index">
		<!--  -->
		<div class = "box box-success" ng-show = "nos.criterion.length">	
			<div class = "box-header with-border">
	            <div class="col-md-4">
	            	<h3 class = "box-title"> @{{nos.level.title}} - @{{nos.level.name}}</h3>
	        	</div>		        
			</div>
			<div class="box-body col-md-6" ng-repeat = "no in nos.criterion track by $index">
				<div class = "box box-primary">
			        <div class = "box-header with-border panel-success">
			            <div class="col-md-4">
			            	<h3 class = "box-title"> Level - @{{no.titleGroup}}</h3>
			        	</div>
						<div class="text-right">
	          				<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveContributionRateOrEffort(this.no,'rate')" >Save</button>
	        			</div>		        
			        </div>
			        <div class = "box-body ">
			            <table class="table table-striped table-bordered table-hover table-sm">
							<thead >
							    <tr class="bg-primary">
							      <th class="col-md-4">Criterian Name </th>
							      <th class="col-md-1">Percent(%) </th>
							    </tr>
							</thead>
					  		<tbody >
							    <tr  ng-repeat = "step in no.criteria">
							    	<td>	
										@{{step.title}} - @{{step.name}}
							    	</td>
							    	<td >
							    		<div class="col-md-10">
							    			<input class = "form-control" type = "number" min="0" max="99" id = "name" ng-model = "step.percent">
							    		</div>
							    	</td>	
							    </tr>
						  	</tbody>
						</table>
			        </div>
		        </div>    
		    </div>
		</div>
	</div>


	<div class="panel-footer col-md-12">
		<div class="col-md-6">
			<a type="button" class="btn btn-danger"  href = "/projects/{{$id}}/criterio">Back - Criterian table</a>
		</div>
		<div class="col-md-6">
			<a type="button" class="btn btn-success  pull-right"  href = "/projects/{{$id}}/criterio/effort_level">Next - Effort level </a>
		</div>
	</div>	 
</div>

@endsection

