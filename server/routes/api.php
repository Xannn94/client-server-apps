<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/departments','API\DepartmentController@index');
Route::get('/departments/{department}','API\DepartmentController@show');
Route::post('/departments','API\DepartmentController@store');
Route::put('/departments/{department}','API\DepartmentController@update');
Route::delete('/departments/{department}','API\DepartmentController@destroy');

Route::get('/employees','API\EmployeeController@index');
Route::get('/employees/{employee}','API\EmployeeController@show');
Route::post('/employees','API\EmployeeController@store');
Route::put('/employees/{employee}','API\EmployeeController@update');
Route::delete('/employees/{employee}','API\EmployeeController@destroy');
