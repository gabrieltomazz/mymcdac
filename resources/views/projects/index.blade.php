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
						            <th>Objeto de pesquisa</th>
						            <th>data inicio</th>
						            <th>Critérios</th>
						            <th></th>
						        </tr>
					        	<tbody >
					        		<tr ng-repeat = "instance in instances">
							           <td> 
							           		<a href = "projects/edit/@{{ instance.id }}/">
							           		@{{instance.objeto_pesquisa}}
							           		</a>
							           	</td> 
							           <td>@{{instance.data_inicio}}</td> 
							           <td>
	                                        <a href = "projects/@{{ instance.id }}/criterio/level">
	                                            Criterio
	                                        </a>
                                    	</td>
							           <td class = "acoes">
                                        	<i class = "fa fa-times" ng-click = "remove(instance)"></i>
                                       </td> 
							        </tr>
					
					        	</tbody>
							</table>
							<div ng-if = "!instances.length" class = "text-muted margin">Nenhum registro encontrado</div>
	                	</div>
	                </div>
                </div>
            </div>
        </div>
    </div>
	</section>
</div>


<!--  ng-class = "!project.active ? 'bg-warning' : ''" -->
@endsection
