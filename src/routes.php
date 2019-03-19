<?php

use Illuminate\Support\Facades\Route;

Route::get('/password_policy_reset','Simplesales\PasswordPolicy\Http\Controllers\PasswordPolicyController@show')->name('reset-password');
Route::post('/password_policy_reset','Simplesales\PasswordPolicy\Http\Controllers\PasswordPolicyController@store')->name('reset-password.store');