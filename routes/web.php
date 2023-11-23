<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', "reportes\home@index");
Route::get('getDataInactivosTable', "reportes\home@getDataInactivosTable");
Route::get('getDataInactivos', "reportes\home@getDataInactivos");

// reporte de  link generados Mercado Pago Perú - Sara Dolores
Route::get('mplinks', "reportes\home@mplinks");
Route::get('getMplinksData', "reportes\home@getMplinksData");