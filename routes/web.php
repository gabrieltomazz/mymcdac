<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('index');
});
// Route::get('users', function()
// {
//     return 'Mamadecisão!';
// });

Route::get('users', 'UsersController@index');
Route::get('account', 'AccountController@index')->name('account');
Route::post('update', 'AccountController@update')->name('update');



Route::group(['middleware' => 'auth'], function () {
	//Route::post('/projects/store/?.*', 'ProjectController@store');
	
	Route::get('projects', 'ProjectController@index');
	Route::get('projects/create', 'ProjectController@create');
	Route::post('projects/store/', 'ProjectController@store');
	Route::get('projects/find/{id}', 'ProjectController@find');
	Route::get('projects/find_project/{id}', 'ProjectController@findProject');
	Route::get('projects/edit/{id}', "ProjectController@edit");
	Route::get('projects/remove/{id}', 'ProjectController@remove');

	Route::get('projects/{project_id}/criterio', 'CriterionController@index');
	Route::get('projects/{project_id}/criterio/level', 'CriterionController@level');
	Route::get('projects/{project_id}/criterio/level1', 'CriterionController@level1');
	Route::get('projects/{project_id}/criterio', 'CriterionController@criterio');
	Route::post('criterions/store/', 'CriterionController@store');
	Route::get('criterions/find/{id}', 'CriterionController@find');
	Route::get('criterions/find_tree/{id}', 'CriterionController@findTree');
	Route::get('criterions/remove/{id}', 'CriterionController@remove');



});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Facebook Routes
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
