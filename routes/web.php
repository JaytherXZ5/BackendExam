<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{notFound}', function(){
    return view('welcome');
})->where('notFound', ".*");