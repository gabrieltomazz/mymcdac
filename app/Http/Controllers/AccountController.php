<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

use Carbon\Carbon;
use App\Http\Requests;

use App\Exceptions\BusinessException;

use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    
    use RegistersUsers;

    public function index(){
        return view('account');
    }

    protected function update(Request $request)
    {

        $users = User::FindOrNew($request->id);
        $users->fill($request->all());
        $users->update();
       

        return $users;



    }

}
