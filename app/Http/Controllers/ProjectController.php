<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\OptionAnswer;
use App\Scale;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\ProjectsFormRequest;

use App\Exceptions\BusinessException;

use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function index(){
        return view('projects.index');
    }
    public function create(){
        return view('projects.edit',[
            'id' => "create"
        ]);
    }

    public function edit($id){
        return view('projects.edit',[
            'id' => $id
        ]);
    }

    public function find($user_id){
        $project = Project::with(['scale']);
        $project->where('user_id',$user_id);
        return $project->get();
    }
    
    public function findProject($id){
        $project = Project::with(['scale']);
        $project->where('id',$id);
        
        return $project->get();
    
    }

    public function getAnswersByProject($id){
        $project = Project::join('option_answers', 'option_answers.scale_id' ,'=' ,'projects.scale_id');
        $project->where('projects.id',$id);

        return $project->get();
    }

    public function store(ProjectsFormRequest $request){

    	$project = Project::FindOrNew($request->id);
    	$project->fill($request->all());
        $project->user_id = $request->user_id;
        $project->scale_id = $request->scale_id;
    	$project->save();

    	return $project;
    }

    public function remove($id){

        Project::findOrFail($id)->delete();

    }
}
