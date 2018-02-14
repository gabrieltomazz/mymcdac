<div class="container" ng-controller="CriterionController" ng-init="find({{$id}})">
	<div class="container" >
		<h3> Effort Levels</h3>
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
          				<button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="saveEffort(listOfLevels)" >Save</button>
        			</div>		        
		        </div>
		        <div class = "box-body ">
		            <table class="table table-striped table-bordered table-hover table-sm">
						<thead >
						    <tr class="bg-primary">
						      <th class="col-md-4">Criterian Name </th>
						      <th class="col-md-1">Effort </th>
						    </tr>
						</thead>
				  		<tbody >
						    <tr  ng-repeat = "no in listOfLevels">
						    	<td>	
									@{{no.level.title}} - @{{no.level.name}}
						    	</td>
						    	<td >
						    		<div class="col-md-10">
						    			<input class = "form-control" type="number" id="name" ng-value="project.number" >
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
		<div class = "box box-success">	
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
	          				<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveEffort(no.criteria)" >Save</button>
	        			</div>		        
			        </div>
			        <div class = "box-body ">
			            <table class="table table-striped table-bordered table-hover table-sm">
							<thead >
							    <tr class="bg-primary">
							      <th class="col-md-4">Criterian Name </th>
							      <th class="col-md-1">Effort </th>
							    </tr>
							</thead>
					  		<tbody >
							    <tr  ng-repeat = "step in no.criteria">
							    	<td>	
										@{{step.title}} - @{{step.name}}
							    	</td>
							    	<td >
							    		<div class="col-md-10">
							    			<input class = "form-control" type="number" id="name" ng-value="effortNumber.number" >
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
</div>

