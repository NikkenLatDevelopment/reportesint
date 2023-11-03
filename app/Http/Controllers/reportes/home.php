<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;

class home extends Controller{
    public function index(){
        return view('home');
    }

    public function getDataInactivos(){
        $coreApp = new coreApp();
        $data['data'] = $coreApp->execSQLQuery("EXEC PLAN_INFLUENCIA_MK.dbo.sgtPerfecto_ReporteInternoRegresaACasa;", "SQL173");
        return $data;
    }
}
