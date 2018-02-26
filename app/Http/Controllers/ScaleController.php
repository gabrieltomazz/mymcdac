<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scale;

class ScaleController extends Controller
{
   public function getScaleWithoutUser(){
   		
   		$scales = Scale::with(['optionAnswer']);
   		$scales->where('user_id',null);
     	
     	return $scales->get();
   }
   public function getScaletUser($id_user){

     	return Scale::findOrFail($id_user);
   }
}
