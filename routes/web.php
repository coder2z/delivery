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
//登陆
Route::get('/', function () {
    return view('Users.login');
})->name('login');
Route::post('/users/login', 'Users\UsersController@login')->middleware('throttle:5');
//注册
Route::get('/register', function () {
    return view('Users.register');
});
Route::post('/users/register', 'Users\UsersController@register');

Route::group(['middleware' => 'auth:user'], function () {
//登出
    Route::get('/users/logout', 'Users\UsersController@logout');
    Route::get('/index', function () {
        return view('index');
    });
    Route::get('/welcome', function () {
        return view('Welcome.index');
    });
    Route::get('/welcome/index', 'Welcome\IndexController@index');
    Route::get('/user/index', function () {
        return view('Users.index');
    });
    Route::get('/user/add', function () {
        return view('Users.add');
    });
    Route::post('/user/add', 'Users\UsersController@add');
    Route::post('/user/del', 'Users\UsersController@del');
    Route::post('/user/check', 'Users\UsersController@check');
    Route::post('/user/index', 'Users\UsersController@index');
    Route::get('/user/password/{id}', function ($id) {
        return view('Users.password')->with('id', $id);
    })->where('id', '[0-9]+');
    Route::post('/user/password', 'Users\UsersController@update');
    Route::get('/borrow/index', function () {
        return view('Borrow.index');
    });
    Route::post('/borrow/index', 'Borrow\BorrowController@index');
    Route::get('/borrow/add', function () {
        return view('Borrow.add');
    });
    Route::post('/borrow/add', 'Borrow\BorrowController@add');
    Route::get('/borrow/rangs', 'Borrow\BorrowController@rangs');
    Route::get('/borrow/useradd', function () {
        return view('Borrow.useradd');
    });
    Route::post('/borrow/useradd', 'Borrow\BorrowController@useradd');
    Route::get('/borrow/del', 'Borrow\BorrowController@del');
    Route::get('/borrow/admin', function () {
        return view('Borrow.admin');
    });
    Route::get('/borrow/update/{id}', function ($id) {
        return view('Borrow.update')->with('id', $id);
    })->where('id', '[0-9]+');
    Route::post('/borrow/update', 'Borrow\BorrowController@update');
    Route::get('/borrow/get/{id}', 'Borrow\BorrowController@get')->where('id', '[0-9]+');
    Route::get('/borrow/export', function () {
        return view('Borrow.export');
    });
    Route::get('/company/index', function () {
        return view('Company.index');
    });
    Route::post('/company/index', 'Company\CompanyController@index');
    Route::post('/company/del', 'Company\CompanyController@del');
    Route::get('/company/add', function () {
        return view('Company.add');
    });
    Route::get('/company/get_range', 'Company\CompanyController@getrange');
    Route::post('/company/add', 'Company\CompanyController@add');
    Route::get('/company/allranges/{id}', function ($id) {
        return view('Company.allranges')->with('id', $id);
    })->where('id', '[0-9]+');
    Route::post('/company/allranges', 'Company\CompanyController@allranges');
    Route::get('/company/update/{id}', function ($id) {
        return view('Company.update')->with('id', $id);
    })->where('id', '[0-9]+');
    Route::post('/company/update/{id}', 'Company\CompanyController@update');
    Route::get('/company/get/{id}', 'Company\CompanyController@get')->where('id', '[0-9]+');
    Route::post('/company/update', 'Company\CompanyController@update');
    Route::get('/company/getnexus', 'Company\CompanyController@getnexus');
    Route::post('/excel/export','Member\MemberController@export')->name('/excel/export');
});
