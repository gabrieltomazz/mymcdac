<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\OptionAnswer;
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
        $project = Project::with(['optionAnswer']);
        $project->where('user_id',$user_id);
        //dd($project);
        return $project->get();
    }
    public function findProject($id){
        return $project = Project::with(['optionAnswer'])->findOrFail($id);
    
    }

    public function store(ProjectsFormRequest $request){

    	$project = Project::FindOrNew($request->id);
    	$project->fill($request->all());
        $project->user_id = $request->user_id;
    	$project->save();
        
        $this->saveOptionsAnswer($project,$request->option_answer);

    	return $project;
    }

    public function saveOptionsAnswer(Project $project, $answers ){
        
        foreach($answers as $answersArr){
            
            if($answersArr['id'] != null){
              $optionAnswer = OptionAnswer::findOrNew($answersArr['id']);
              $optionAnswer->id = $answersArr['id'];
              $optionAnswer->answer = $answersArr['answer'];
              $optionAnswer->project_id = $project->id;
              $optionAnswer->save();  
            }else{
               $optionAnswer = new OptionAnswer($answersArr);
               $optionAnswer->project_id = $project->id;
               $optionAnswer->save(); 
            }
            
        }  
        // $optionAnswer->ruim = $answers->op['ruim'];
        // $optionAnswer->regular = $answers->op['regular'];

    }

    public function remove($id){

        Project::findOrFail($id)->delete();

    }
}
