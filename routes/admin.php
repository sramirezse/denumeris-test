<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
Route::get('/', function(){
    return redirect('admin/dashboard');
});
Route::get('{path}', function () {
    return view('layouts/admin/app');
})->where('path', '(.*)');
