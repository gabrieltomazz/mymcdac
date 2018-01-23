@extends('layouts.logged')

@section('content')

<div class="container">
	<h2>Qualidade de Transporte - DF</h2>
	<p>Descrição do Projeto ...</p>
	<ul class="nav nav-pills">
		<li class="active" ><a data-toggle="pill" href="#table">Criterian Table</a></li>
		<li><a data-toggle="pill" href="#priority" >Priority Levels</a></li>
		<li><a data-toggle="pill" href="#level1">Level 1</a></li>
		<li><a data-toggle="pill" href="#level2">Level 2</a></li>
		<li><a data-toggle="pill" href="#level2">level 2</a></li>
		<li><a data-toggle="pill" href="#level3">level 3</a></li>
	</ul>
	
</div>

<div class="tab-content">
	<div id="table" class="tab-pane fade in active">
		@include("criterion.criterio")
	</div>
	<div id="priority" class="tab-pane">
		@include("criterion.priority_levels")
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