<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "reportes\home@index");
Route::get('getDataInactivosTable', "reportes\home@getDataInactivosTable");
Route::get('getDataInactivos', "reportes\home@getDataInactivos");

## reporte de  link generados Mercado Pago Perú - Sara DoloresW
Route::get('mplinks', "reportes\home@mplinks");
Route::get('getMplinksData', "reportes\home@getMplinksData");

## reporte de  link generados Mercado Pago Perú - Sara Dolores
Route::get('VP_VGP_Inactivos', "reportes\home@VP_VGP_Inactivos");
Route::get('VP_VGP_InactivosData', "reportes\home@VP_VGP_InactivosData");

## Reportes Retos Especiales Carolina
Route::get('reportesRetos', 'reportesRetos\reportesRetos@reportesRetos');

Route::get('reportVolGlobal', 'reportesRetos\reportesRetos@reportVolGlobal');

