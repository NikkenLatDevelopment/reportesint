<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', "reportes\home@index");
Route::get('getDataInactivosTable', "reportes\home@getDataInactivosTable");
Route::get('getDataInactivos', "reportes\home@getDataInactivos");