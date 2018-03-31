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

Route::get('/', function () {
    return view('index');
});
// Route::get('users', function()
// {
//     return 'Mamadecisão!';
// });

Route::get('users', 'UsersController@index');
Route::get('privacy_notice', 'UsersController@privacy');




Route::group(['middleware' => 'auth'], function () {
	//Route::post('/projects/store/?.*', 'ProjectController@store');
	Route::get('account', 'AccountController@index')->name('account');
	Route::post('update', 'AccountController@update')->name('update');
	
	Route::get('projects', 'ProjectController@index');
	Route::get('projects/create', 'ProjectController@create');
	Route::post('projects/store/', 'ProjectController@store');
	Route::get('projects/find/{id}', 'ProjectController@find');
	Route::get('projects/find_project/{id}', 'ProjectController@findProject');
	Route::get('projects/edit/{id}', "ProjectController@edit");
	Route::get('projects/remove/{id}', 'ProjectController@remove');
	Route::get('projects/answers_by_project/{id}', 'ProjectController@getAnswersByProject');

	Route::get('option_answer/remove/{id}', 'OptionAnswerController@remove');
	Route::get('option_answer/remove_by_project/{project_id}', 'OptionAnswerController@removeByIdProject');

	Route::get('scale/all/{id}', "ScaleController@getAll");
	Route::get('scale/find_by_user/{id}', "ScaleController@getScaletUser");
	Route::get('scale/remove/{id}', 'ScaleController@remove');
	Route::post('scale/store/', 'ScaleController@store');


	Route::get('projects/{project_id}/criterio', 'CriterionController@criterio');
	Route::get('projects/{project_id}/criterio/contribution_rate', 'CriterionController@contributionRate');
	Route::get('projects/{project_id}/criterio/effort_level', 'CriterionController@effortLevel');
	Route::get('projects/{project_id}/criterio/median_scale', 'CriterionController@medianScale');
	Route::get('projects/{project_id}/order_criterio', 'CriterionController@orderCriterio');
	
	
	Route::post('criterions/store/', 'CriterionController@store');
	Route::post('criterions/save_order/', 'CriterionController@saveSort');
	Route::post('criterions/save_scale_result', 'CriterionController@saveScaleResult');
	
	Route::post('criterions/store_details/', 'CriterionController@storeContributionOrEfoort');
	Route::get('criterions/find/{id}', 'CriterionController@find');
	Route::get('criterions/find_tree/{id}', 'CriterionController@findTree');
	Route::get('criterions/remove/{id}', 'CriterionController@remove');
	Route::get('criterions/find_order/{id}', 'CriterionController@findOrder');
	Route::get('criterions/find_order_project/{id}', 'CriterionController@findOrderWithProject');
	Route::get('criterions/find_scale_result_by_criterion/{id}', 'CriterionController@findScaleResultByCriterion');

//teste

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Facebook Routes
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::get('/redirectGoogle', 'SocialAuthController@redirectGoogle');
Route::get('/callbackGoogle', 'SocialAuthController@callbackGoogle');
