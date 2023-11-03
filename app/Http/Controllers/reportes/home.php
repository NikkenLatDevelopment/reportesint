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
        $data = $coreApp->execSQLQuery("SELECT 0 AS totales;", "SQL173");
    }
}
