<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', "reportes\home@index");
Route::get('getDataInactivos', "reportes\home@getDataInactivos");