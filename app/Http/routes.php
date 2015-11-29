<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@Index');
Route::get('/home', 'AdminController@Index');
Route::get('/om_oss/', 'AboutController@Index');
Route::get('/dokumenter/', 'DocumentsController@Index');
Route::get('/vedtekter/', 'ResolutionsController@Index');
Route::get('/ordensregler/', 'HouseRulesController@Index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logg-inn', 'Auth\AuthController@getLogin');
Route::post('/logg-inn', 'Auth\AuthController@postLogin');
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin', 'Auth\AuthController@getLogin');

Route::get('admin/logout', 'Auth\AuthController@getLogout');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/registrer', 'Auth\AuthController@getRegister');
Route::post('/registrer', 'Auth\AuthController@postRegister');

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

/* added by blog */
Route::get('/post','PostController@index');

//authentication
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth']], function() {

    /* DASHBOARD */
    Route::get('/dashboard', 'UserController@dashboard');

    /* POSTER / POSTS */
    Route::get('/mine-poster', 'PostController@my_posts');

    Route::get('ny-post','PostController@create');
    Route::post('ny-post','PostController@store');
    Route::get('edit/{slug}','PostController@edit');
    Route::post('update','PostController@update');
    Route::get('delete/{id}','PostController@destroy');

    Route::get('my-drafts','UserController@user_posts_draft');
    Route::post('comment/add','CommentController@store');
    Route::post('comment/delete/{id}','CommentController@destroy');

    /* DOKUMENTER / DOCUMENTS */
    Route::get('/mine-dokumenter', 'DocumentsController@my_documents');
    Route::get('/last-opp', 'DocumentsController@upload');
    Route::post('/upload', ['as' => 'upload', 'uses' => 'DocumentsController@store']);
});

/* BRUKER / USERS */
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
