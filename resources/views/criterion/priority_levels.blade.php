<div class="container" ng-controller="CriterionController" ng-init="find({{$id}})">
	<div class="container" >
		<h3> Priority Levels</h3>
	</div>
	<div ng-repeat = "nos in listOfLevels track by $index">
		<div class="col-md-6">
			<div class = "box box-primary">
		        <div class = "box-header with-border panel-primary">
		            <div class="col-md-4">
		            	<h3 class = "box-title"> Level @{{$index+1}}</h3>
		        	</div>
					<div class="text-right">
          				<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="savePriority(nos.level)" >Save</button>
        			</div>		        
		        </div>
		        <div class = "box-body ">
		            <table class="table table-striped table-bordered table-hover table-sm">
						<thead >
						    <tr class="bg-primary">
						      <th class="col-md-4">Criterian Name </th>
						      <th class="col-md-2">Priority </th>
						    </tr>
						</thead>
				  		<tbody >
						    <tr  ng-repeat = "no in nos.criterions">
						    	<td>	
									@{{no.title}} - @{{no.name}}
						    	</td>
						    	<td >
						    		<div class="col-md-8">
						    			<input class = "form-control" type="number" id="name" ng-value="priority.number" >
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