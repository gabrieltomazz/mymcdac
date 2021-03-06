<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OptionAnswer;

class OptionAnswerController extends Controller
{
     public function getOptions($id_projects){

     	return OptionAnswer::findOrFail($id_projects);
     }

	 public function remove($id){
	 	
	 	OptionAnswer::findOrFail($id)->delete();
	 }

	 public function removeByIdProject($project_id){
	 	OptionAnswer::where('project_id',$project_id)->delete();
	 }
}
