@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')">
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
</div>

<div ng-controller="ScaleController" ng-init="findOrderProject({{$id}})">
	<div ng-if="loadPage == true"> 
		<div class="container">	
			<div ng-repeat = "lastNode in data">
				<div class="container" >
					<h3> @{{lastNode.title}} - @{{lastNode.name}} @{{instance.objeto_pesquisa}}</h3>
				</div>
				<div class="container">
					<table class="table table-striped table-bordered table-hover table-sm">
					  <thead >
					    <tr class="bg-primary">
					      <th>Option Answer </th>
					      <th>Impact level</th>
					      <th>Mark</th>
					      <th>Scale</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat = "opcoes in lastNode.scales track by $index">
					      <th scope="row">@{{opcoes.answer}}</th>
					      <td>N@{{$index + 1}}</td>
					      <td><input type="radio" name="median@{{opcoes.n_id}}" class="form-check-input" ng-change="changeMedian(opcoes,lastNode.scales)" ng-model="opcoes.median" ng-value=1></td>
					      <td>@{{opcoes.value}}</td>
					    </tr>
					   
					  </tbody>
					</table>
				</div>
			</div>

			<div class="panel-footer col-md-12">
				<div class="col-md-6">
					<a type="button" class="btn btn-danger"  href = "/projects/{{$id}}/order_criterio">Back - Order Criterio</a>
				</div>
				<div class="col-md-6">
					<a type="button" class="btn btn-success  pull-right" ng-click="updateMedianChoose({{$id}})">Next</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div ng-if = "loadPage == false">
			<div class="text-center">
				<h1> Loading...  <i class='fa fa-circle-o-notch fa-spin'></i> </h1>
			</div>	
		</div>
	</div>	
</div>

@endsection