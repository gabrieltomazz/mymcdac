<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criterion;

class CriterionController extends Controller
{
    public function index(){
    	 return view('criterion.criterio');
    }
    public function level($id){
         return view('criterion.level',[
            'id' => $id
        ]);
    }
    public function level1(){
         return view('criterion.level1');
    }
    public function criterio(){
         return view('criterion.criterio');
    }

    public function store(Request $request){
        //dd($project);
    	$criterion = Criterion::FindOrNew($request->id);
    	$criterion->fill($request->all());
        $criterion->criterion_id = $request->criterion_id;
        $criterion->project_id = $request->project_id;
        
    	$criterion->save();
       

    	return $criterion;
    }

    public function find($project_id){
        
        $criterion = Criterion::with(['node']);
        $criterion->where('project_id',$project_id);
        //dd($project);
        return $criterion->get();
    }

    public function findTree($id){
        
        $criterion = Criterion::FindOrNew($id);
        
        //dd($project);
        return $criterion;
    }

    public function remove($id){

        Criterion::findOrFail($id)->delete();

    }



}
