<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;

class LaporanPemakaianController extends Controller
{
    function index() {
        $laporan = Pemakaian::where('labor_komputer_id', Auth()->user()->assignment[0]->labkom->id)->get();
        return view('teknisi.laporanPemakaian')->with('title','Laporan Pemakaian Labor')->with('laporan',$laporan);
    }
}
