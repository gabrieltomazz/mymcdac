<div ng-controller="CriterionController" ng-init="find({{$id}})" >
	<div class="container" >
		<h3> Rótulo da Pesquisa</h3>
	</div>
	<div class="container">
		<table class="table table-striped table-bordered table-hover table-sm">
		  <thead >
		    <tr>
		      <th class="bg-primary">@{{project.objetivo_pesquisa}}</th>
		      <th>@{{project.desempenho_max}}</th>
		      <th class="bg-success">@{{project.objeto_pesquisa}}</th>
		      <th>@{{project.desempenho_min}}</th>
		      <th>Percent (%)</th>
		    </tr>
		  </thead>
		  <tbody  >
		    <tr ng-repeat = "no in levels.level1">
		      <th scope="row">@{{no.title}} - @{{no.name}}</th>
		      <td>167</td>
		      <td class="bg-success">101</td>
		      <td>-32</td>
		      <td>30</td>
		    </tr>
		    
		    <tr>
		      <th scope="row" class="bg-info">Total</th>
		      <td>177</td>
		      <td class="bg-success">100</td>
		      <td class="bg-danger">-45</td>
		      <td>100</td>
		    </tr>
		  </tbody>
		</table>
	
		<div class = "col-md-6">
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
    	</div>
    	<div class = "col-md-6">
			<div class = "box box-primary">
		        <div class = "box-header with-border panel-primary">
		            <h3 class = "box-title">Gráfico - 2</h3>
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