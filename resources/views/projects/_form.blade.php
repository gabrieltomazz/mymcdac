
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary" >
            	
                <div class="panel-heading" ng-show="instance.id == null" >Create Project</div>
                <div class="panel-heading" ng-show="instance.id != null" >Update Project</div>

                <div class="panel-body" >
                    <div class="form-horizontal" >
                        
                        <div class="form-group">
                            <label for="objetivo_pesquisa" class="col-md-4 control-label">Objetivo pesquisa:</label>

                            <div class="col-md-6">
                                <input id="objetivo_pesquisa" type="text" class="form-control" name="objetivo_pesquisa" ng-model="instance.objetivo_pesquisa" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Objeto Pesquisa</label>

                            <div class="col-md-6">
                                <input id="objeto_pesquisa" type="text" class="form-control" name="objeto_pesquisa" ng-model="instance.objeto_pesquisa" change-on-blur="setDesempenho(instance.objeto_pesquisa)" required autofocus>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desempenho" class="col-md-4 control-label">Desempenho</label>

                            <div class="col-md-6">
                                <input id="desempenho" type="text" class="form-control" name="desempenho" ng-model="instance.desempenho" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desempenho_max" class="col-md-4 control-label" >Desempenho Max </label>

                            <div class="col-md-6">
                                <input id="desempenho_max" type="text" class="form-control" name="desempenho_max" ng-model="instance.desempenho+'Max'" placeholder="QualisMax" disabled="" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="desempenho_min" class="col-md-4 control-label">Desempenho Min</label>

                            <div class="col-md-6">
                                <input id="desempenho_min" type="text" class="form-control" name="desempenho_min" ng-model="instance.desempenho+'Min'" placeholder="QualisMin" disabled="" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="steps" class="col-md-4 control-label">Degraus</label> 
                            <div class = "col-md-2">
                                <select id = "steps" class = "form-control" ng-model = "instance.steps" required autofocus>
                                    <option ng-value ="3" >3</option>
                                    <option ng-value ="4" >4</option>
                                    <option ng-value ="5" >5</option>
                                    <option ng-value ="6" >6</option>
                                    <option ng-value ="7" >7</option>
                                    <option ng-value ="8" >8</option>
                                    <option ng-value ="9" >9</option>
                                </select>
                            </div>   
                        </div>

                      	<div class="form-group">
                            <label for="data_inicio" class="col-md-4 control-label">Data Inicio</label>

                            <div class="col-md-6">
                                <input id="data_inicio" type="text" mask-date="" class="form-control" name="data_inicio" ng-model="instance.data_inicio"  placeholder="28/03/2017" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data_fim" class="col-md-4 control-label">Data Fim</label>

                            <div class="col-md-6">
                                <input id="data_fim" type="text" mask-date="" class="form-control" name="data_fim" ng-model="instance.data_fim"  placeholder="28/03/2017" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    Opções de Reposta:
                </div>
                <div class = "panel-body ">
                    <table class="table table-bordered " > 
                        <tr class="table-primary">
                            <th class=" table-primary">
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="option1">
                                </label>
                                <a data-toggle="collapse" href="#option1" role="button" aria-expanded="false" aria-controls="collapseOne">
                                    Option 1       
                                </a>
                            </th>
                            <th>
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="option2">
                                </label>
                                <a data-toggle="collapse" href="#option2" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                    Option 2 
                                </a>
                            </th>
                            <th>
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="option3">
                                </label>
                                <a data-toggle="collapse" href="#option3" role="button" aria-expanded="false" aria-controls="collapseThree">
                                    Option 3 
                                </a>
                            </th>
                            <th class=" table-primary">
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="option4">
                                </label>
                                <a data-toggle="collapse" href="#option4" role="button" aria-expanded="false" aria-controls="collapseFour">
                                    Option 4       
                                </a>
                            </th>
                            <th class=" table-primary">
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="others">
                                </label>
                                <a data-toggle="collapse" href="#others" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Others      
                                </a>
                            </th>
                        </tr>

                    </table>
                    <div class="form-group">
                        <div class="collapse" id="option1">
                          <div class="card card-body">
                            <div class="col-md-3" ng-repeat = "option in instance.option_answer.option1 track by $index">
                                <label for = "options">N@{{$index + 1}}</label>
                                <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                            </div>
                          </div>
                        </div>
                        <div class="collapse" id="option2">
                          <div class="card card-body">
                            <div class="col-md-3" ng-repeat = "option in instance.option_answer.option2 track by $index">
                                <label for = "options">N@{{$index + 1}}</label>
                                <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                            </div>
                          </div>
                        </div>
                        <div class="collapse" id="option3">
                          <div class="card card-body">
                            <div class="col-md-3" ng-repeat = "option in instance.option_answer.option3 track by $index">
                                <label for = "options">N@{{$index + 1}}</label>
                                <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                            </div>
                          </div>
                        </div>
                        <div class="collapse" id="option4">
                          <div class="card card-body">
                            <div class="col-md-3" ng-repeat = "option in instance.option_answer.option4 track by $index">
                                <label for = "options">N@{{$index + 1}}</label>
                                <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                            </div>
                          </div>
                        </div>
                        <div class="collapse" id="others">
                          <div class="card card-body">
                            <div class="col-md-3" ng-repeat = "option in instance.option_answer.others track by $index">
                                <label for = "options">N@{{$index + 1}}</label>
                                <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                <a class="pull-right btn btn-danger btn-xs" ng-click="deleteOption(this)"><span
                                class="glyphicon glyphicon-remove"></span></a>
                            </div>
                            <div class = "col-md-3">
                                <div class = "form-group-sm">
                                    <label for = "answer">&nbsp;</label>
                                    <div>
                                        <a class = "btn btn-info btn-sm" href = "javascript:void(0)" ng-click = "addOp()"><span class = "glyphicon glyphicon-plus"></span>Add</a>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>     
            </div>   
            <div class="row">
                <div class="form-group">
                    <div class = "col-md-2" ng-show="instance.id == null" >
                        <button type="submit" class="btn btn-primary" ng-click='store({{ Auth::user()->id }})'>
                            Register
                        </button>
                    </div>
                    <div class = "col-md-2" ng-show="instance.id != null">
                        <button type="submit" class="btn btn-primary" ng-click='store({{ Auth::user()->id }})'>
                            Update
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


 <!-- <div class = "box-body ">
                    <div class="form-group">
                        <div class="col-md-3" ng-repeat = "option in instance.option_answer track by $index">
                            <label for = "options">N@{{$index + 1}}</label>
                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                        </div>

                        <div class = "col-md-3">
                            <div class = "form-group-sm">
                                <label for = "answer">&nbsp;</label>
                                <div>
                                    <a class = "btn btn-info btn-sm" href = "javascript:void(0)" ng-click = "addOp()"><span class = "glyphicon glyphicon-plus"></span>Add</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>  --> 