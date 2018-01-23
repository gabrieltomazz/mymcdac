<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\User;


class AccountController extends Controller
{
    public function index(){
        return view('account');
    }

    protected function update(array $data){
        // return User::save([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'university' => $data['university'],
        //     'country' => $data['country'],
        // ]);

        $data = User::findOrNew($data->id);
        $data->fill($data->all());
        $data->save();

        return $data;
    }

}
