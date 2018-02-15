<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;


class AccountController extends Controller
{

    public function index(){
        return view('account');
    }

    protected function update(Request $request)
    {

        $users = User::FindOrNew($request->id);
        $users->fill($request->all());
        $users->save();
       
        return $users;

    }

}
