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
Route::post('/register', ['as' => 'register'], 'Auth\AuthController@postRegister');
Route::get('/registrer', 'Auth\AuthController@getRegister');
Route::post('/registrer', ['as' => 'registrer', 'uses' => 'Auth\AuthController@postRegister']);

/* added by blog */
Route::get('/post','PostController@index');

//authentication
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth']], function() {

    /* ADMIN */
    Route::get('/admin/users', function() {
        return View::make('admin.users')->with('username', Auth::user()->name);
    });
    Route::get('/admin/user_edit/{id}', 'AdminController@user_edit');
    Route::post('/admin/edit_user', 'AdminController@edit_user');

    Route::get('/admin/users', 'AdminController@user_administration');

    /* DASHBOARD */
    Route::get('/dashboard', 'UserController@dashboard');
    Route::get('/endre-passord', function() {
        return View::make('member.password')->with('username', Auth::user()->name);
    });
    Route::post('/endre-passord', ['as' => 'endre-passord', 'uses' => 'UserController@changePassword']);

    Route::get('/epostlister', function() {
        return View::make('member.maillist')->with('username', Auth::user()->name);
    });

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
    Route::get('/mine-dokumenter', ['as' => 'mine-dokumenter', 'uses' => 'DocumentsController@my_documents']);
    Route::match(['get', 'post'], '/last-opp', ['as' => 'last-opp', 'uses' => 'DocumentsController@upload']);
    Route::post('/upload', ['as' => 'upload', 'uses' => 'UploadsController@upload']);
    Route::get('/documents/delete/{id}', 'DocumentsController@destroy');
    Route::match(['get', 'post'], '/documents/store', 'DocumentsController@store');

    /* REFERATER / PROTOCOLS */
    Route::get('/protocols/delete/{id}', 'ProtocolsController@destroy');
    Route::get('/protocols/toggle/{id}', 'ProtocolsController@toggle');
});

/* BRUKER / USERS */
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
