<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('adminLogin', function(){
    return view("adminLogin");
})->name("adminLogin");