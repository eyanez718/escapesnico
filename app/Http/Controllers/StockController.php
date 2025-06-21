<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Insumo;
use App\Models\Material;

class StockController extends Controller
{
    /**
     * Retorna la vista de stock
     * 
     * @return vista stock.index
     */
    public function index()
    {
        return view('stock.index');
    }

    /**
     * Retorna la vista de importación de precios
     * 
     * @return vista stock.importar_litado_precios
     */
    public function importarListadoPrecios()
    {
        return view('stock.importar_listado_precios');
    }

    /**
     * Procesa un listado de precios
     * 
     * @return vista stock.importar_litado_precios
     */
    public function procesarListadoPrecios(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ], [
            'file.required' => 'El archivo es obligatorio.',
            'file.file' => 'El archivo debe ser un archivo válido.',
            'file.mimes' => 'El archivo debe ser un archivo de tipo: xlsx, xls o csv.',
        ]);

        $path = $request->file('file')->getRealPath();

        // Carga el archivo Excel
        $spreadsheet = IOFactory::load($path);

        // Obtiene la hoja activa (por ejemplo, la primera hoja)
        $sheet = $spreadsheet->getActiveSheet();

        // Obtiene todas las filas como array
        $rows = $sheet->toArray();
        
        $filaCero = true;

        $contador = 0;
        foreach ($rows as $row) {
            if (!$filaCero) {
                if ($row[0] == 'insumo') {
                    $insumo = Insumo::where('codigo', '=', $row[1])->first();
                    $insumo->update([
                        'costo_unitario' => $row[2],
                    ]);
                    $contador += 1;
                } elseif ($row[0] == 'material') {
                    $material = Material::where('codigo', '=', $row[1])->first();
                    $material->costo_unitario = (double) $row[2];
                    $material->save();
                    $contador += 1;
                }
            } else {
                $filaCero = false;
            }
        }
        return redirect()->route('stock.index')->with('success', 'Precios importados correctamente (' . $contador . ' actualizaciones)');
    }
}
