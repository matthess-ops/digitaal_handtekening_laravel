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
});

//non protected routes - authentication stuff sigup and resetpassword
Route::post('signup','SignupController@signup');
Route::post('resetpassword', 'PasswordController@reset');

Route::post('createsigning','SignatureController@create');

Route::get('adminsigneddocuments','SignatureController@index');

Route::get('usersigneddocuments','SignatureController@userIndex');

Route::post('changestatus', 'SignatureController@changeStatus');




// Route::get('/testdb', 'TestController@testdb');








// Route::get("unprotected",'TestController@unprotected');
// Route::get("unprotectedpost",'TestController@unprotectedpost');

// Route::post('test','UserController@test');


// Route::get('clients', 'ClientController@index');
// Route::get('clients/{id}', 'ClientController@show');
// Route::post('clients', 'ClientController@store');
// Route::put('clients/{id}', 'ClientController@update');
// Route::delete('clients/{id}', 'ClientController@delete');
// Route::get('clients/search/{id}', 'ClientController@search');




// Route::post('downloadtxt','DocumentController@downloadtxt');
// Route::get('downloadpdf/{id}','DocumentController@downloadpdf');
// Route::get('downloadworksttttt/{id}','DocumentController@downloadworks');




// Route::get('sendbasicemail','MailController@basic_email');
// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');




// // Verb          Path                        Action  Route Name
// // GET           /users                      index   users.index
// // POST          /users                      store   users.store
// // GET           /users/{user}               show    users.show
// // PUT|PATCH     /users/{user}               update  users.update
// // DELETE        /users/{user}               destroy users.destroy


