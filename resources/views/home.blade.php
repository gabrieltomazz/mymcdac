@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <a href="{{ url('/projects') }}">Create Project</a>
            </div>
          <!--  <div class="form-group">
                <label for="criterio" class="col-md-4 control-label">Name</label>
                <div class="col-md-3">
                    <input id="criterio" type="text" class="form-control" name="name"  >
                </div>
            </div> -->

            <!-- <div>
                <table class="table table-bordered">
                      <thead class="thead-inverse">
                        <tr>
                          <th>PVF(Requisitos)</th>
                          <th>SubPVF()</th>
                          <th>Maior Esforço SubPVF</th>
                          <th>Maior Esforço PVF</th>
                          <th>Geral</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>

                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                </table> 
            </div> -->
            
        </div>
    </div>
</div>
@endsection
