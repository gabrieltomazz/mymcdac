
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary" >
            	
                <div class="panel-heading" ng-show="instance.id == null" >Create Project</div>
                <div class="panel-heading" ng-show="instance.id != null" >Update Project</div>

                <div class="panel-body" >
                    <div class="form-horizontal" >
                        
                        <div class="form-group">
                            <label for="objetivo_pesquisa" class="col-md-4 control-label">Project goal:</label>

                            <div class="col-md-6">
                                <input id="objetivo_pesquisa" type="text" class="form-control" name="objetivo_pesquisa" ng-model="instance.objetivo_pesquisa" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Project locus: </label>

                            <div class="col-md-6">
                                <input id="objeto_pesquisa" type="text" class="form-control" name="objeto_pesquisa" ng-model="instance.objeto_pesquisa" change-on-blur="setDesempenho(instance.objeto_pesquisa)" required autofocus>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desempenho" class="col-md-4 control-label">Performace:</label>

                            <div class="col-md-6">
                                <input id="desempenho" type="text" class="form-control" name="desempenho" ng-model="instance.desempenho" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desempenho_max" class="col-md-4 control-label" >Performace Max </label>

                            <div class="col-md-6">
                                <input id="desempenho_max" type="text" class="form-control" name="desempenho_max" ng-model="instance.desempenho+'Max'" placeholder="QualisMax" disabled="" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="desempenho_min" class="col-md-4 control-label">Performace Min</label>

                            <div class="col-md-6">
                                <input id="desempenho_min" type="text" class="form-control" name="desempenho_min" ng-model="instance.desempenho+'Min'" placeholder="QualisMin" disabled="" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="steps" class="col-md-4 control-label">Steps</label> 
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
                            <label for="data_inicio" class="col-md-4 control-label">Start date</label>

                            <div class="col-md-6">
                                <input id="data_inicio" type="text" mask-date="" class="form-control" name="data_inicio" ng-model="instance.data_inicio"  placeholder="28/03/2017" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data_fim" class="col-md-4 control-label">End date</label>

                            <div class="col-md-6">
                                <input id="data_fim" type="text" mask-date="" class="form-control" name="data_fim" ng-model="instance.data_fim"  placeholder="28/03/2017" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <h5 class ="col-md-4">
                        Measurement Scale
                    </h5>    
                    <div class="text-right">
                        <button class="btn btn-success"  href="{{ url('/scale/create') }}">Create Scale <span class="glyphicon glyphicon-plus"></span></button>
                    </div>
                </div>
                <div class = "panel-body ">
                    <label> You might choose here, the Measurement Scale used in your research survey. If you choose 'Other measurement scale' option, you should input the used scale</label>
                    <div class = " panel-group col-md-12">
                        <select id = "scale_id" class = "form-control" ng-model = "scale" ng-options = "scale.description for scale in scales track by scale.id">
                                <option value = "">.: Selecione :.</option>
                            </select>
                     </div>
                </div>
            </div>   
            
            <div class="row">
                <div class="form-group">
                    <div class = "col-md-2" ng-show="instance.id == null" >
                        <button type="submit" class="btn btn-primary" ng-click='store({{ Auth::user()->id }})'>
                            Save
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
<!-- <div class = "panel-body ">
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div >
                                <label class="checkbox-inline">
                                    <a href="#option1"></a>
                                    <input type="radio"  class="form-check-input" ng-model="instance.option" value="option1">
                                </label>
                                <a data-toggle="collapse" href="#option1"> Poor - Fair - Good - Very Good </a>
                                
                              </div>
                            </div>
                            <div id="option1" class="panel-collapse collapse">
                              <div class="panel-body"> 
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option1 track by $index">
                                    <div class="col-md-4" >
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                              <div>
                                <label class="checkbox-inline">
                                    <a href="#option2"></a>
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="option2">
                                </label>
                                <a data-toggle="collapse" href="#option2" > Very Poor - Poor - Fair - Good - Very good </a>
                                
                              </div>
                            </div>
                            <div id="option2" class="panel-collapse collapse">
                              <div class="panel-body">
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.option2 track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N@{{$index + 1}}</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                        </div>
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info" >
                            <div class="panel-heading" >
                              <div>
                                <label class="checkbox-inline">
                                            <input type="radio" class="form-check-input" ng-model="instance.option" value="option3">
                                </label>
                                <a  data-toggle="collapse" href="#option3"> Extremely bad - Very bad - Bad - Good - Very good - Extremely good</a>
                              </div>
                            </div>
                            <div id="option3" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option3 track by $index">
                                    <div class="col-md-4">
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div>
                                <label class="checkbox-inline">
                                    <input type="radio" href="#option4" class="form-check-input" ng-model="instance.option" value="option4">
                                </label>
                                <a data-toggle="collapse" href="#option4" > Very bad - Bad - Somewhat good - Good - Very good - Extremely good</a>
                                
                              </div>
                            </div>
                            <div id="option4" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option4 track by $index">
                                    <div class="col-md-4">
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div>
                                <label class="checkbox-inline">
                                    <input type="radio" class="form-check-input" ng-model="instance.option" value="others">
                                </label>
                                <a data-toggle="collapse" href="#others" >Others </a>
                                
                              </div>
                            </div>
                            <div id="others" class="panel-collapse collapse">
                              <div class="panel-body">
                                    <label  style=" color:red" ><p class="text-center"> Sugere-se que utilize até 7 questões por motivos de  limitações cognitivas dos respondentes</p></label>
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.others track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N@{{$index + 1}}</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                            <a class="pull-right btn btn-danger btn-xs" ng-click="deleteOption(this)"><span
                                            class="glyphicon glyphicon-remove"></span></a>
                                        </div>
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
                </div>  -->   




                <!--
                <div class = "panel panel-primary">
                <div class = "panel-heading">
                    Options
                </div>
                <div class="panel-body"> 
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div >
                                <a data-toggle="collapse" href="#option1"> Very poor - Neutral - Good - Very Good - Excelent </a>
                              </div>
                            </div>
                            <div id="option1" class="panel-collapse collapse">
                              <div class="panel-body"> 
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option1 track by $index">
                                    <div class="col-md-4" >
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div >
                                <a data-toggle="collapse" href="#option2"> Poor - Fair - Good - Very Good </a>
                                
                              </div>
                            </div>
                            <div id="option2" class="panel-collapse collapse">
                              <div class="panel-body"> 
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option2 track by $index">
                                    <div class="col-md-4" >
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                              <div>
                                <a data-toggle="collapse" href="#option3" > Very Poor - Poor - Fair - Good - Very good </a>
                              </div>
                            </div>
                            <div id="option3" class="panel-collapse collapse">
                              <div class="panel-body">
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.option3 track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N@{{$index + 1}}</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                        </div>
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info" >
                            <div class="panel-heading" >
                              <div>
                                <a  data-toggle="collapse" href="#option4"> Extremely bad - Very bad - Bad - Good - Very good - Extremely good</a>
                              </div>
                            </div>
                            <div id="option4" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option4 track by $index">
                                    <div class="col-md-4">
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div>
                                <a data-toggle="collapse" href="#option5" > Very bad - Bad - Somewhat good - Good - Very good - Extremely good</a>
                                
                              </div>
                            </div>
                            <div id="option5" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="col-md-12" ng-repeat = "option in instance.option_answer.option5 track by $index">
                                    <div class="col-md-4">
                                        <label for = "options">N@{{$index + 1}}</label>
                                        <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading" >
                              <div>
                                <a data-toggle="collapse" href="#others" >Others </a>
                              </div>
                            </div>
                            <div id="others" class="panel-collapse collapse">
                              <div class="panel-body">
                                    <label  style=" color:red" ><p class="text-center"> Sugere-se que utilize até 7 questões por motivos de  limitações cognitivas dos respondentes</p></label>
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.positive track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer" style="border-color: blue;" placeholder="level">
                                            <a class="pull-right btn btn-danger btn-xs" ng-click="deleteOption(this)"><span
                                                            class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.neutral track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer"  placeholder="level">
                                        </div>
                                    </div>
                                    <div class="col-md-12" ng-repeat = "option in instance.option_answer.negative track by $index">
                                        <div class="col-md-4" >
                                            <label for = "options">N</label>
                                            <input id="option_answer.@{{ $index }}.answer" type="text" class="form-control" name="answer" ng-model="option.answer" style="border-color: red;"  placeholder="level">
                                            <a class="pull-right btn btn-danger btn-xs" ng-click="deleteOption(this)"><span
                                                            class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                    </div>
                                    <div class = "col-md-3">
                                        <div class = "form-group-sm">
                                            <label for = "answer">&nbsp;</label>
                                            <div>
                                                <a class = "btn btn-info btn-sm" href = "javascript:void(0)" ng-click = "addOpPositive()"><span class = "glyphicon glyphicon-plus"></span>Positive</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-3">
                                        <div class = "form-group-sm">
                                            <label for = "answer">&nbsp;</label>
                                            <div>
                                                <a class = "btn btn-danger btn-sm" href = "javascript:void(0)" ng-click = "addOpNegative()"><span class = "glyphicon glyphicon-minus"></span>Negative</a>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div> -->                        