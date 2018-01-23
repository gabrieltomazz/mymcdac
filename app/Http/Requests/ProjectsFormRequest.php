<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;

class ProjectsFormRequest extends Request{

    public function authorize() {
        return Auth::check() && Auth::user();
    }


    public function rules() {
        return [
            "objetivo_pesquisa" => "required|max:255",
            // "show_on_menu" => "required|boolean",
            // "active" => "required|boolean",
        ];
    }
}