@extends('layouts.logged')

@section('content')

<div class="container" ng-controller="ProjectController" ng-init="findProject('{{$id}}')" >
	<h2>@{{instance.objetivo_pesquisa}}</h2>
	<p>@{{instance.objeto_pesquisa}}</p>
</div>

<div ng-controller="ResultController" ng-init="find({{$id}})">
	<div class="container">
		<ul class="nav nav-pills" >
			<li class="active" ><a data-toggle="pill" href="#table">Leaf</a></li>
			<li><a data-toggle="pill" href="#mainCriterian" >Main Criterian</a></li>
			<li><a data-toggle="pill" href="#final">Final</a></li>
		</ul>
	</div>

	<div class="tab-content" ng-show="loadingData == true">
		<div id="table" class="tab-pane fade in active">
			<div class="container" >
				<div class="container" >
					<h3> Results</h3>
				</div>
				<div ng-repeat = "nos in listOfLevels track by $index" >
					<div class="col-md-12" ng-repeat = "no in nos.criterion track by $index">
						<div class="container" >
							<h4>@{{no.titleGroup}}@{{no.level.name}}</h4>
						</div>
						<div class="container col-md-9" >
							<table class="table table-striped table-bordered table-hover table-sm">
							  <thead >
							    <tr>
							      <th class="bg-primary">Criterian</th>
							      <th>@{{project.desempenho}}Max</th>
							      <th class="bg-success">@{{project.desempenho}}</th>
							      <th>@{{project.desempenho}}Min</th>
							      <th>Percent (%)</th>
							    </tr>
							  </thead>
							  <tbody  >
							    <tr ng-repeat = "step in no.criteria">
							      <th scope="row">@{{step.title}} - @{{step.name}}</th>
							      <td>@{{step.performaceMax}}</td>
							      <td class="bg-success">@{{step.performaceMedia}} </td>
							      <td>@{{step.performaceMin}}</td>
							      <td>@{{step.percent}}</td>
							    </tr>
							    
							    <tr>
							      <th scope="row" class="bg-info">Total</th>
							      <td> @{{no.level.performaceMax}} </td>
							      <td class="bg-success">@{{no.level.performaceMedia}}</td>
							      <td class="bg-danger">@{{no.level.performaceMin}}</td>
							      <td>100</td>
							    </tr>
							  </tbody>
							</table>
						</div>
						
						<div class="col-md-3">
							<table class="table table-striped table-bordered table-hover table-sm">
								<thead >
									<tr>
									  <th>Model definition</th>
									  <th>Scale</th>
									</tr>
								</thead>
								<tbody  >
									<tr ng-repeat = "option in no.level.scales">
									  	<th scope="row">@{{option.answer}}</th>
									  	<td>@{{option.value}}</td>  
									</tr>
								</tbody>
							</table>
						</div>
						<!-- <div class="col-md-6">
							<div class = "box box-primary">
						        <div class = "box-header with-border panel-primary">
						            <h3 class = "box-title">Gráfico - 1</h3>
						        </div>
						        <div class = "box-body ">
						            <div class="row">
										<canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick">
										</canvas>
									</div>
						        </div>    
					        </div> 
				    	</div>  -->
					</div>
				</div>	
			</div>	 
		
		</div>
		
		<div id="mainCriterian" class="tab-pane" ng-show="loadingData == true">
			<div class="container" >
				<div class="container" >
					<h3> Main Criterian</h3>
				</div>
				<div ng-repeat = "nos in listOfLevels track by $index" >
					<div class="col-md-12" >
						<div class="container" >
							<h4>@{{nos.level.name}}</h4>
						</div>
						<div class="container col-md-9" >
							<table class="table table-striped table-bordered table-hover table-sm">
							  <thead >
							    <tr>
							      <th class="bg-primary">Criterian</th>
							      <th>@{{project.desempenho}}Max</th>
							      <th class="bg-success">@{{project.desempenho}}</th>
							      <th>@{{project.desempenho}}Min</th>
							      <th>Percent (%)</th>
							    </tr>
							  </thead>
							  <tbody  >
							    <tr ng-repeat = "step in nos.criterion">
							      <th scope="row">@{{step.level.title}} - @{{step.level.name}}</th>
							      <td>@{{step.level.performaceMax}}</td>
							      <td class="bg-success">@{{step.level.performaceMedia}} </td>
							      <td>@{{step.level.performaceMin}}</td>
							      <td>@{{step.level.percent}}</td>
							    </tr>
							    
							    <tr>
							      <th scope="row" class="bg-info">Total</th>
							      <td> @{{nos.level.performaceMax}} </td>
							      <td class="bg-success"> @{{nos.level.performaceMedia}} </td>
							      <td class="bg-danger">@{{nos.level.performaceMin}}</td>
							      <td>100</td>
							    </tr>
							  </tbody>
							</table>
						</div>
						
						<div class="col-md-3">
							<table class="table table-striped table-bordered table-hover table-sm">
								<thead >
									<tr>
									  <th>Model definition</th>
									  <th>Scale</th>
									</tr>
								</thead>
								<tbody  >
									<tr ng-repeat = "option in nos.level.scales">
									  	<th scope="row">@{{option.answer}}</th>
									  	<td>@{{option.value}}</td>  
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<div class = "box box-primary">
						        <div class = "box-header with-border panel-primary">
						            <h3 class = "box-title">Gráfico - 1</h3>
						        </div>
						        <div class = "box-body ">
						            <div class="row">
										<canvas id="line" class="chart chart-line" chart-data="nos.data" chart-labels="nos.labels" chart-series="nos.series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick">
										</canvas>
									</div>
						        </div>    
					        </div> 
				    	</div> 
					</div>
				</div>	
			</div>	
		</div>

		<div id="final" class="tab-pane fade" ng-show="loadingData == true">
			<div class="container" >
				<div class="container" >
					<h3> Search Label</h3>
				</div>
				<div class="col-md-12">
					<div class="container col-md-9">
						<table class="table table-striped table-bordered table-hover table-sm">
						  <thead >
						    <tr>
						      <th class="bg-primary">@{{project.objetivo_pesquisa}}</th>
						      <th>@{{project.desempenho}}Max</th>
						      <th class="bg-success">@{{project.desempenho}}</th>
						      <th>@{{project.desempenho}}Min</th>
						      <th>Percent (%)</th>
						    </tr>
						  </thead>
						  <tbody  >
						    <tr ng-repeat = "no in listOfLevels">
						      <th scope="row">@{{no.level.title}} - @{{no.level.name}}</th>
						      <td>@{{no.level.performaceMax}}</td>
						      <td class="bg-success">@{{no.level.performaceMedia}}</td>
						      <td>@{{no.level.performaceMin}}</td>
						      <td>@{{no.level.percent}}</td>
						    </tr>
						    
						    <tr>
						      <th scope="row" class="bg-info">Total</th>
						      <td>@{{finalResult.performaceMax}}</td>
						      <td class="bg-success">@{{finalResult.performaceMedia}}</td>
						      <td class="bg-danger">@{{finalResult.performaceMin}}</td>
						      <td>100</td>
						    </tr>
						  </tbody>
						</table>
					</div>
					
					<div class="col-md-3">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead >
								<tr>
								  <th>Model definition</th>
								  <th>Scale</th>
								</tr>
							</thead>
							<tbody  >
								<tr ng-repeat = "option in finalResult.scales">
								  	<th scope="row">@{{option.answer}}</th>
								  	<td>@{{option.value}}</td>  
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-6 col-sm-12 ng-scope">
						<div class = "box box-primary">
					        <div class = "box-header with-border panel-primary">
					            <h3 class = "box-title">Chart - 1</h3>
					        </div>
					        <div class = "box-body ">
					            <div class="row">
									<canvas id="line" class="chart chart-line" chart-data="mainChartData" chart-labels="mainLabels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick">
									</canvas>
								</div>
					        </div>    
				        </div> 
				    </div> 
				    <div class="col-md-6">
				    	<div class = "box box-primary">
					        <div class = "box-header with-border panel-primary">
					            <h3 class = "box-title">Chart - 2</h3>
					        </div>
					        <div class = "box-body ">
					            <div class="row">
									<canvas id="bar" class="chart chart-bar"
				  					chart-data="datas" chart-labels="label" chart-series="serie">
									</canvas>
								</div>
					    	</div>    
		        		</div>	
				    </div> 
				</div>		
			</div>	 
		</div>
	</div>

	<div class="container">
		<div ng-show = "loadingData == false">
			<div class="text-center">
				<h1> Loading...  <i class='fa fa-circle-o-notch fa-spin'></i> </h1>
			</div>	
		</div>
	</div>
</div>		
@endsection	