<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'central.landing')->name('central.landing');

Route::get('/register', 'RegisterTenantController@show')->name('central.tenants.register');
Route::post('/register/submit', 'RegisterTenantController@submit')->name('central.tenants.register.submit');

Route::get('/login', 'LoginTenantController@show')->name('central.tenants.login');
Route::post('/login/submit', 'LoginTenantController@submit')->name('central.tenants.login.submit');

