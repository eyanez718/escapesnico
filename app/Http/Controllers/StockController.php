<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
