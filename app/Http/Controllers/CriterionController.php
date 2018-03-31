<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criterion;
use App\SortLastCriteria;
use App\ScaleResult;

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

    public function orderCriterio($id){
         return view('criterion.order_criterion',[
            'id' => $id
        ]);
    }

    public function store(Request $request){
    	$criterion = Criterion::FindOrNew($request->id);
    	$criterion->fill($request->all());
        $criterion->criterion_id = $request->criterion_id;
        $criterion->project_id = $request->project_id;
        
    	$criterion->save();
       

    	return $criterion;
    }

    public function saveSort(Request $request){
        foreach($request->all() as $criteriaArr)
        {
            //SortLastCriteria::where('criterion_id',$criteriaArr['id'])->delete();

            $criteria = SortLastCriteria::FirstOrNew(['criterion_id' =>$criteriaArr['id']]);
            $criteria->criterion_id = $criteriaArr['id'];
            $criteria->order = $criteriaArr['order'];
            $criteria->project_id = $criteriaArr['project_id'];

            $criteria->save();
            
        }
        return $request;
        
    }

    public function saveScaleResult(Request $request)
    {
        foreach($request->all() as $requestArr)
        {
            foreach($requestArr['scales'] as $scaleArr)
            {
                $scale = ScaleResult::FirstOrNew(['id' =>$scaleArr['id']]);
                $scale->value = $scaleArr['value'];
                $scale->median = $scaleArr['median'];
                $scale->criterion_id = $scaleArr['criterion_id'];
                $scale->option_answer_id = $scaleArr['option_answer_id'];

                $scale->save();
            }    
            
        }
        return $request;

    }

    public function findOrder($project_id){
        $criterion = SortLastCriteria::join('criterions','sort_last_criteria.criterion_id' ,'=' ,'criterions.id');
        $criterion->where('sort_last_criteria.project_id',$project_id);
        $criterion->orderBy('order','ASC');
        return $criterion->get();
    }

    public function findOrderWithProject($project_id){
        $criterion = SortLastCriteria::join('criterions','sort_last_criteria.criterion_id' ,'=' ,'criterions.id');
        $criterion->where('sort_last_criteria.project_id',$project_id);
        $criterion->with(['project']);
        $criterion->orderBy('order','ASC');
        return $criterion->get();
    }

    public function findScaleResultByCriterion($criterion_id)
    {
        $scales = ScaleResult::where('criterion_id',$criterion_id);

        return $scales->get();
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
