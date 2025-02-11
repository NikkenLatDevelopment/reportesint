<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


date_default_timezone_set('America/Mexico_City');
class coreApp extends Controller{
    public function execMySQLQuery($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->select($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execMySQLQueryUpdate($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->update($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execMySQLQueryInsert($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->insert($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execMySQLQueryDelete($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->delete($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execSQLQuery($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->select($query);
        \DB::disconnect($db);
        return $data;
    }
    
    public function execSQLQueryInsert($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->insert($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execSQLQueryUpdate($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->update($query);
        \DB::disconnect($db);
        return $data;
    }

    public function execSQLQueryDelete($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->delete($query);
        \DB::disconnect($db);
        return $data;
    }
    
    public function execSQLQueryStatement($query, $db){
        $conexion = \DB::connection($db);
            $data = $conexion->statement($query);
        \DB::disconnect($db);
        return $data;
    }

    public function getFlag($country){
        switch($country){
            case 1:
                return "colombia.png";
                break;
            case 2:
                return "mexico.png";
                break;
            case 3:
                return "peru.png";
                break;
            case 4:
                return "ecuador.png";
                break;
            case 5:
                return "panama.png";
                break;
            case 6:
                return "guatemala.png";
                break;
            case 7:
                return "salvador.png";
                break;
            case 8:
                return "costarica.png";
                break;
            case 10:
                return "chile.png";
                break;
            default:
                return "mexico.png";
                break;
        }
    }

    public function error403(){
        return view('error.403');
    }

    public function getMontPeriod($periodo){
        // $periodo = "202308";
        $mes = substr($periodo, -2);
        $anio = substr($periodo, 0, 4);

        $mesesLtr = [
            '01' => "Enero",
            '02' => "Febrero",
            '03' => "Marzo",
            '04' => "Abril",
            '05' => "Mayo",
            '06' => "Junio",
            '07' => "Julio",
            '08' => "Agosto",
            '09' => "Septiembre",
            '10' => "Octubre",
            '11' => "Noviembre",
            '13' => "Diciembre",
        ];

        return $mesesLtr[$mes] . " " . $anio;
    }

    public function getReportBody($stmt, $conn, $h){
        $stmt = $this->execSQLQuery("$stmt", "$conn");
        $filaData = [];
        $data = [];
        $data[] = $h;
        if (!empty($stmt)) {
            $primerRegistro = (array)$stmt[0];
            $headers = array_keys($primerRegistro);
            foreach ($stmt as $fila) {
                $filaArray = (array)$fila;
                foreach ($headers as $header) {
                    $filaData[$header] = $filaArray[$header] ?? null;
                }
                $data[] = $filaData;
            }
        }
        return $data;
    }
}
