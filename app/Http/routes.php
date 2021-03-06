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

/* PUBLIC PAGES */
Route::get('/', 'WelcomeController@Index');
Route::get('/om_oss/', 'AboutController@Index');
Route::get('/vedtekter/', 'ResolutionsController@Index');
Route::get('/dokumenter/', 'DocumentsController@Index');
Route::get('/dokumenter/styrereferater', 'DocumentsController@boardDocuments');
Route::get('/dokumenter/arsmoter', 'DocumentsController@annualMeetingsDocuments');
Route::get('/dokumenter/ovrige', 'DocumentsController@generalDocuments');
Route::get('/ordensregler/', 'HouseRulesController@Index');

/* LOGIN */
Route::get('/admin/logg-inn', 'Auth\AuthController@getLogin');
Route::get('/admin/logg-ut', 'Auth\AuthController@getLogout');

/* VERIFICATIONS */
Route::get('/verify/{token}', 'UserController@verify_user');
Route::get('/verification', function() {
    return View::make('auth.preface');
});

/* AUTHENTICATIONS */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/* MIDDLEWARE AUTH */
Route::group(['middleware' => ['auth']], function() {

    /* ADMIN */
    Route::get('/admin/edit_user/{id}', 'AdminController@editUser');
    Route::post('/admin/edit_user', 'AdminController@updateUser');
    Route::get('/admin/brukere/oversikt', 'AdminController@userAdministration');
    Route::get('/admin/confirm_member_application/{id}', 'UserController@confirmMemberApplication');
    Route::get('/admin/ignore_member_application/{id}', 'UserController@ignoreMemberApplication');
    Route::get('/admin/block_member_application/{id}', 'UserController@blockMemberApplication');

    /* DASHBOARD */
    Route::get('/admin/dashboard', 'UserController@dashboard');

    /* USER PROFILE */
    Route::get('/endre-passord', function() {
        return View::make('member.password')->with('username', Auth::user()->name);
    });
    Route::post('/endre-passord', ['as' => 'endre-passord', 'uses' => 'UserController@changePassword']);

    /* MAIL-LISTS */
    Route::get('/epostlister', function() {
        return View::make('member.maillist')->with('username', Auth::user()->name);
    });

    /* POSTER / POSTS */
    Route::get('/admin/poster/alle', 'PostController@landingPage');
    Route::post('/admin/poster/alle', 'PostController@landingPage');

    Route::get('/admin/poster/ny','PostController@create');
    Route::post('/admin/poster/lagre','PostController@store');

    Route::get('/admin/poster/egne', 'PostController@showOwnPosts');

    Route::get('/admin/poster/rediger/{slug}','PostController@edit');
    Route::post('update','PostController@update', function() {
        return Redirect('/');
    });

    Route::get('/admin/poster/slett/{id}','PostController@destroy');

    /* DOKUMENTER / DOCUMENTS */
    Route::get('/dokumenter/godkjenn/{id}', 'ProtocolsController@toggleApproval');

    Route::get('/admin/dokumenter/egne', ['as' => '/admin/dokumenter/egne', 'uses' => 'DocumentsController@my_documents']);
    Route::get('/admin/dokumenter/alle', ['as' => '/admin/dokumenter/alle', 'uses' => 'DocumentsController@all_documents']);
    Route::match(['get', 'post'], '/admin/dokumenter/last-opp', ['as' => 'last-opp', 'uses' => 'DocumentsController@upload']);
    Route::post('/upload', ['as' => 'upload', 'uses' => 'UploadsController@upload']);
    Route::get('/documents/delete/{id}', 'DocumentsController@destroy');
    Route::match(['get', 'post'], '/documents/store', 'DocumentsController@store');

    /* REFERATER / PROTOCOLS */
    Route::get('/protocols/delete/{id}', 'ProtocolsController@destroy');
    Route::get('/protocols/toggle/{id}', 'ProtocolsController@toggle');
});

/* POSTS */
#Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');