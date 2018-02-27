<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scale;
use App\OptionAnswer;


class ScaleController extends Controller
{
   public function getAll($user_id){
   		
   		$scales = Scale::with(['optionAnswer']);
   		$scales->Where('user_id',$user_id);
   		$scales->orWhere('user_id', null);
   	
     	return $scales->get();
   }
   
   public function getScaletUser($id_user){

     	$scaleUser = Scale::with(['optionAnswer']);
     	$scaleUser->where('user_id',$id_user);
     	
     	return $scaleUser->get(); 
   }

   public function remove($id){

   		Scale::findOrFail($id)->delete();

   }

   public function store(Request $request){

   		$scale = Scale::FindOrNew($request->id);
    	$scale->fill($request->all());
        $scale->user_id = $request->user_id;
    	$scale->save();

    	$this->saveOptionsAnswer($scale,$request->option_answer);


    	return $scale;
   }


   public function saveOptionsAnswer(Scale $scale, $answers ){
        
        foreach($answers as $answersArr){
            
            if($answersArr['id'] != null){
              $optionAnswer = OptionAnswer::findOrNew($answersArr['id']);
              $optionAnswer->id = $answersArr['id'];
              $optionAnswer->answer = $answersArr['answer'];
              $optionAnswer->neutral = $answersArr['neutral'];
              $optionAnswer->good = $answersArr['good'];
              $optionAnswer->scale_id = $scale->id;
              $optionAnswer->save();  
            }else{
               $optionAnswer = new OptionAnswer($answersArr);
               $optionAnswer->scale_id = $scale->id;
               $optionAnswer->save(); 
            }
            
        }  
    }
}
