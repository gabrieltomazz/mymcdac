<?php
namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller {

    public function index(){
        return view('users');
    }

    public function privacy(){
    	return view('privacy_notice');
    }
}