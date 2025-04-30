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
Route::get('posibleAvance', 'reportesRetos\reportesRetos@posibleAvanceData');
Route::get('kinyaHistoric', 'reportesRetos\reportesRetos@kinyaHistoricData');

Route::get('vReporteVEmprendedores','reportesRetos\reportesRetos@vReporteVEmprendedores');
Route::get('reportCVEmprendedor','reportesRetos\reportesRetos@reportCVEmprendedor');

Route::get('depuracion_lat_2025','reportesRetos\reportesRetos@depuracion_lat_2025');

Route::get('reporteEmprendedor25','reportesRetos\retos2025@reporteEmprendedor25');
Route::get('reporteViajero25','reportesRetos\retos2025@reporteViajero25');
Route::get('reporteVip25','reportesRetos\retos2025@reporteVip25');

Route::get('estCHLexefixeed', 'otros\otros@estCHLexe');
Route::get('estVHLideresfixeed', 'otros\otros@estVHLideres');
Route::get('downloadReportvc300', 'otros\otros@downloadReportvc300');

Route::get('homeCheckBonos', 'otros\otros@homeCheckBonos');
Route::get('reportCheckBonos', 'otros\otros@reportCheckBonos');
Route::get('homeCheckBonos_vcplus', 'otros\otros@homeCheckBonos_vcplus');
Route::get('reportCheckBonos_vcplus', 'otros\otros@reportCheckBonos_vcplus');
Route::get('homeReportVolum', 'otros\otros@homeReportVolum');
Route::get('reportVolum', 'otros\otros@reportVolum');
Route::get('download_rep_volumenes_rec', 'otros\otros@download_rep_volumenes_rec');

Route::get('getReportSalesTvKueski', 'otros\otros@getReportSalesTvKueski');
Route::get('getReportSalesTv3DS', 'otros\otros@getReportSalesTv3DS');


Route::get('reporte_fichados', 'otros\otros@ficha2');