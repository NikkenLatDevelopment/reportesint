<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\coreApp;

class ventaGeneralController extends Controller
{
    public function index()
    {
        return view('VentaGeneral.ventaGeneral');
    }
    public function getData()
    {
        try {
            $dbName = 'SQL173';
            $pdo = \DB::connection($dbName)->getPdo();
            $stmt = $pdo->prepare("EXEC Soporte_Regional.dbo.SP_Regional_VentaPendiente_WEB");
            $stmt->execute();

            // Inicializamos siempre como arrays vacíos
            $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];

            $ventas = [];
            if ($stmt->nextRowset()) {
                $ventas = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
            }

            $detalles = [];
            if ($stmt->nextRowset()) {
                $detalles = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
            }

            return \Response::json([
                'usuarios' => $usuarios,
                'ventas' => $ventas,
                'detalles' => $detalles
            ]);

        } catch (\Exception $e) {
            // Si falla el SP o la conexión, mandamos el error con código 500
            return \Response::json(['error' => $e->getMessage()], 500);
        }
    }
}