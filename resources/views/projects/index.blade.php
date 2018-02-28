@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="find({{ Auth::user()->id }})">
   <section class = "content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">  
               <div class="panel-heading" > 
            		<div class="col-md-4"> 
            			My MCDA-C Projects 
            		</div>
            		<div class="text-right">
	       				<a href="{{ url('/projects/create') }}">Create Project <span class="glyphicon glyphicon-plus"></span></a>
            		</div>
            	</div>
                <div class = "box-body table-responsive">
	                <div class="panel-body" >
	                	<div >
	                		<table class = "table table-hover table-striped table-bordered" id = "tabelaProjects">
						        <tr>
						            <th nowrap="">Project locus</th>
						            <th>Scale</th>
						            <th>Start date</th>
						            <th>Criterian</th>
						            <th></th>
						        </tr>
					        	<tbody >
					        		<tr ng-repeat = "instance in instances">
							           <td> 
							           		<a href = "projects/edit/@{{ instance.id }}/">
							           		@{{instance.objeto_pesquisa}}
							           		</a>
							           	</td> 
							           <td>@{{instance.scale.description | limitTo: 15}} (...)</td> 
							           <td>@{{instance.data_inicio}}</td> 
							           <td>
	                                        <a href = "projects/@{{ instance.id }}/criterio/level">
	                                            Criterian
	                                        </a>
                                    	</td>
							           <td class = "acoes">
                                        	<a href="" style="color:black"><i class = "fa fa-times" ng-click = "remove(instance)"></i></a>
                                       </td> 
							        </tr>
					
					        	</tbody>
							</table>
							<div ng-if = "!instances.length" class = "text-muted margin">Nenhum registro encontrado</div>
	                	</div>
	                </div>
                </div>
            </div>

            <div class="panel panel-default">  
               <div class="panel-heading" > 
            		<div class="col-md-4"> 
            			My Scales 
            		</div>
            		<div class="text-right">
	       				<a href="#" data-toggle="modal" data-target="#myModal" ng-click="reset()">Create Scale <span class="glyphicon glyphicon-plus"></span></a>
            		</div>
            	</div>
                <div class = "box-body table-responsive">
	                <div class="panel-body" >
	                	<div >
	                		<table class = "table table-hover table-striped table-bordered" id = "tabelaProjects">
						        <tr>
						            <th>Scale description</th>
						            <th>Num of items</th>
						            <th></th>
						        </tr>
					        	<tbody >
					        		<tr ng-repeat = "scale in scales_main">
							           <td> 
							           		<a href = "" ng-click="findScale(scale.id)" data-toggle="modal" data-target="#myModal">
							           		@{{scale.description}}
							           		</a>
							           	</td> 
							           <td>@{{scale.option_answer.length}}</td> 
							           <td class = "acoes">
                                        	<a href="" style="color:black"><i class = "fa fa-times" ng-click = "removeScale(scale)"></i></a>
                                       </td> 
							        </tr>
					
					        	</tbody>
							</table>
							<div ng-if = "!scales_main.length" class = "text-muted margin">Nenhum registro encontrado</div>
	                	</div>
	                </div>
                </div>
            </div>

        </div>
    </div>
	</section>

	<div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"> Description: @{{scale_selected.description}} </h4>     
		          	
		        </div>
		        <div class="modal-body">
			        <div class="form-horizontal" >
				        <table class = "table table-hover table-striped table-bordered" id = "tabelaProjects">
					        <tr>
					            <th>Answer</th>
					            <th>Neutral</th>
					            <th>Good</th>
					            <th></th>
					        </tr>
				        	<tbody >
				        		<tr ng-repeat="option in scale_selected.option_answer track by $index">
						           <td> 
						           		<input id="answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="answer">
						           	</td> 
						           <td class="form-check"><input type="radio" name="checkneutral" class="form-check-input" ng-model="option.neutral" ng-change="changeNeutral(option)" ng-value=1 ng-disabled = "option.good == 1"></td>

						           <td class="form-check"><input type="radio" name="checkgood" class="form-check-input" ng-model="option.good" ng-change="changeGood(option)" ng-value=1 ng-disabled = "option.neutral == 1"></td>
						           <td class = "acoes">
	                                	<a href="" style="color:black"><i class = "fa fa-times" ng-click = "deleteOption(option)"></i></a>
	                               </td> 
						        </tr>
				        	</tbody>
						</table>
						
						
					</div>	
		        </div>

		        <div class="modal-footer">
		        	<div class="col-md-2"> 
            			<a class = "btn btn-info btn-sm" href = "javascript:void(0)" ng-click = "addOp()">Add Answer <span class = "glyphicon glyphicon-plus"></span></a>
            		</div>
            		<div class="text-right">
	       				<button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="saveScales({{ Auth::user()->id }})">Save</button>
            		</div>
		        </div>
		      </div>
		      
		    </div>
	</div>

</div>


<!--  ng-class = "!project.active ? 'bg-warning' : ''" -->
@endsection
