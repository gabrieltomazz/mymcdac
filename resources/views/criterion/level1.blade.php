<div ng-controller="CriterionController" ng-init="find({{$id}})">
	<div ng-repeat = "lastNode in dataTree">
		<div class="container" >
			<h3> @{{lastNode.title}} - @{{lastNode.name}}</h3>
		</div>
		<div class="container">
			<table class="table table-striped table-bordered table-hover table-sm">
			  <thead >
			    <tr class="bg-primary">
			      <th>Opções Modelo </th>
			      <th>Nível Impacto</th>
			      <th>Marque</th>
			      <th>Escala</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr ng-repeat = "opcoes in project.option_answer track by $index">
			      <th scope="row">@{{opcoes.answer}}</th>
			      <td>N@{{$index + 1}}</td>
			      <td><input type="radio" class="form-check-input"></td>
			      <td>168</td>
			    </tr>
			   
			  </tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<div ng-if = "!lastNodes.length" class = "text-muted margin">Register Creterian first</div>
	</div>	
</div>