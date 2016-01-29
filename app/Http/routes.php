<?php
use App\Http\Controllers\JobOpeningController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('job-openings', 'JobOpeningController@showTable');
Route::get('applicants', 'ApplicantController@showTable');

Route::post('job-openings', 'JobOpeningController@store');
Route::post('applicants', 'ApplicantController@store');

Route::post('job-openings/delete', function(Request $request){
    $controller = new JobOpeningController;
    $controller->delete($request);
    return redirect('job-openings');
});
Route::post('applicants/delete', function(Request $request){
    $controller = new ApplicantController;
    $controller->delete($request);
    return redirect('applicants');
});


Route::post('job-openings/update', function(Request $request){
    $controller = new JobOpeningController;
    $controller->update($request);
    return redirect('job-openings');
});
Route::post('applicants/update', function(Request $request){
    $controller = new ApplicantController;
    $controller->update($request);
    return redirect('applicants');
});
//Route::post('applicants/delete', 'ApplicantController@delete');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
