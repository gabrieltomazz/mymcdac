@extends('layouts.logged')

@section("content")

    <div class="project-view" ng-controller="ProjectController" >
        <section class = "content" ng-init = "findProject('{{$id}}')">
            <form id="instance-form">
                @include("projects._form")
            </form>

        </section>
    </div>
@stop