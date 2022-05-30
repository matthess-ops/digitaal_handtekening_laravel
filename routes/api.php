<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// these are the routes that should be authenticated
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('documents', 'DocumentController@index');
    Route::get('userdocuments','DocumentController@userDocuments');
    Route::get('adminuserdocuments/{id}', 'DocumentController@adminGetUserDocuments');
    Route::post('upload', 'DocumentController@upload');
    Route::get('download/{id}','DocumentController@download');
    Route::delete('document/{id}','DocumentController@destroy');
    Route::get('getuserDocument/{userid}/{documentid}','DocumentController@userDocument');
    Route::get('users','UserController@index');
    Route::get('searchuser/{searchTerm}','Usercontroller@search');
    Route::get('adminsigneddocuments','SignatureController@index');
    Route::get('usersigneddocuments','SignatureController@userIndex');
    Route::post('changestatus', 'SignatureController@changeStatus');
    Route::get('downloadsigned/{id}','SignatureController@downloadSigned');

});

//non protected routes - authentication stuff sigup and resetpassword
Route::post('signup','SignupController@signup');
Route::post('resetpassword', 'PasswordController@reset');
Route::post('createsigning','SignatureController@create');



// // Verb          Path                        Action  Route Name
// // GET           /users                      index   users.index
// // POST          /users                      store   users.store
// // GET           /users/{user}               show    users.show
// // PUT|PATCH     /users/{user}               update  users.update
// // DELETE        /users/{user}               destroy users.destroy


