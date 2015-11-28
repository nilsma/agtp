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
Route::get('/admin/dashboard', 'AdminController@Index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Add admin equivs
Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin', 'Auth\AuthController@getLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/dashboard', 'UserController@dashboard');
Route::get('/mine-poster', 'PostController@my_posts');
Route::get('/mine-dokumenter', 'DocumentsController@my_documents');

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

// Add admin equivs
Route::get('admin/register', 'Auth\AuthController@getRegister');
Route::post('admin/register', 'Auth\AuthController@postRegister');

/* added by blog */
Route::get('/post','PostController@index');
#Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
//authentication
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
// check for logged in user
Route::group(['middleware' => ['auth']], function()
{
    // show new post form
    Route::get('ny-post','PostController@create');
    // save new post
    Route::post('ny-post','PostController@store');
    // edit post form
    Route::get('edit/{slug}','PostController@edit');
    // update post
    Route::post('update','PostController@update');
    // delete post
    Route::get('delete/{id}','PostController@destroy');
    // display user's all posts
    #Route::get('my-all-posts','UserController@user_posts_all');
    // display user's drafts
    Route::get('my-drafts','UserController@user_posts_draft');
    // add comment
    Route::post('comment/add','CommentController@store');
    // delete comment
    Route::post('comment/delete/{id}','CommentController@destroy');
});
//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// display single post
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
