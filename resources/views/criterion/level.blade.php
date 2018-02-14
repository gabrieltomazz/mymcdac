@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')">
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
	<ul class="nav nav-pills">
		<li class="active" ><a data-toggle="pill" href="#table">Criterian Table</a></li>
		<li><a data-toggle="pill" href="#contribuition">Contribuition Rate</a></li>
		<li><a data-toggle="pill" href="#priority">Effort Levels</a></li>
		<li><a data-toggle="pill" href="#level1" >Level 1</a></li>
		<li><a data-toggle="pill" href="#level2" >Level 2</a></li>
		<li><a data-toggle="pill" href="#level2">level 2</a></li>
		<li><a data-toggle="pill" href="#level3">level 3</a></li>
	</ul>
</div>

<div class="tab-content">
	<div id="table" class="tab-pane fade in active">
		@include("criterion.criterio")
	</div>
	<div id="contribuition" class="tab-pane" >
		@include("criterion.contribuition_rate")
	</div>
	<div id="priority" class="tab-pane" >
		@include("criterion.effort_levels")
	</div>
	<div id="level1" class="tab-pane">
		@include("criterion.level1")
	</div>

	<div id="level2" class="tab-pane fade">
		@include("criterion.level2")
	</div>

	<div id="level2" class="tab-pane fade">
		@include("criterion.level2")
	</div>

	<div id="level3" class="tab-pane fade">
		@include("criterion.level3")		
	</div>
</div>




@endsection