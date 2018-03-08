<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criterion;

class CriterionController extends Controller
{
    public function criterio($id){
         return view('criterion.criterio',[
            'id' => $id
        ]);
    }

    public function contributionRate($id){
         return view('criterion.contribution_rate',[
            'id' => $id
        ]);
    }

    public function effortLevel($id){
         return view('criterion.effort_levels',[
            'id' => $id
        ]);
    }

    public function medianScale($id){
         return view('criterion.median_scale',[
            'id' => $id
        ]);
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
