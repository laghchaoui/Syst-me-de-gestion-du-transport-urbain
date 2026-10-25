<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('adminlogin', function(){
    return view("adminLogin");
})->name("adminLogin");

Route::get('admin', function(){
    return view('admin');
});