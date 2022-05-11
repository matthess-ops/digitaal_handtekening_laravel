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

});

Route::post('test','UserController@test');


// Route::get('clients', 'ClientController@index');
// Route::get('clients/{id}', 'ClientController@show');
// Route::post('clients', 'ClientController@store');
// Route::put('clients/{id}', 'ClientController@update');
// Route::delete('clients/{id}', 'ClientController@delete');
// Route::get('clients/search/{id}', 'ClientController@search');

Route::post('downloadtxt','DocumentController@downloadtxt');
Route::get('downloadpdf/{id}','DocumentController@downloadpdf');
Route::get('downloadworksttttt/{id}','DocumentController@downloadworks');
Route::post('signup','UserController@signup');
Route::get('users','UserController@index');
Route::get('searchuser/{searchTerm}','Usercontroller@search');

Route::post('/upload', 'FileController@upload');


Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
Route::post('/resetpassword', 'PasswordController@reset');


// Route::get('/download', function () {
//     $filename = 'test.pdf';
//     $pathToFile = public_path().'/'.$filename;
//     error_log("path ".$pathToFile);

//     return Response::make(file_get_contents($pathToFile), 200, [
//       'Content-Type' => 'application/pdf',
//       'Content-Disposition' => 'inline; filename="'.$filename.'"'
//     ]);
//   });
// Route::post('clients', 'ClientController@store');
// Route::put('clients/{id}', 'ClientController@update');
// Route::delete('clients/{id}', 'ClientController@delete');
// Route::get('clients/search/{id}', 'ClientController@search');






// --ClientController--

// index (get /clients): ClientController@index → paginated users list → UserIndexResource (id, firstname,lastname, email, no password) ← check if admin

// show(get /clients/{id}): ClientController@show → get user data → UserShowResource(id, firstname, lastname, email, no password) ← check if admin/same id

// store(post /clients): ClientController@store → validate and new user set is_admin to no → return 404 if created succesfully if not return validation errors

// update(put /clients/{id}) →ClientController@update password reset link naar email sturen - > update password – return 404 or errors

// destroy(delete /clients/{id}) → ClientController@delete → check if user is admin if not do nothing else delete user plus documents. → return ok status or validation errors ← check if admin

// search(get clients/search/{searchstring}) → ClientController@search → search for client firstname, lastname, email → check if admin

// Route::get('clientdata', 'ClientController@index');
// // Route::post('deleteClientData', 'ClientController@delete');
// Route::post('deleteClientData/{id}', 'ClientController@delete');
// Route::post('createclient', 'ClientController@store');
// Route::put('/client/{id}','ClientController@update');


// Route::post('/upload', 'FileController@upload');


// Route::apiResource('product', 'Api\ProductController');

// // Verb          Path                        Action  Route Name
// // GET           /users                      index   users.index
// // POST          /users                      store   users.store
// // GET           /users/{user}               show    users.show
// // PUT|PATCH     /users/{user}               update  users.update
// // DELETE        /users/{user}               destroy users.destroy


