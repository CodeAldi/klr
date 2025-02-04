<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;

class LaporanKepalaLaborController extends Controller
{
    function laporanView() {
        $laporan = Pemakaian::where('labor_komputer_id', Auth()->user()->assignment[0]->labkom->id)->get();
        return view('kepalaLabor.laporanLabor')->with('title','Laporan Penggunaan Komputer')->with('laporan',$laporan);
    }
}
