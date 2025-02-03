<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use App\Models\LaborKomputer;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    function index() {
        $labor = LaborKomputer::all();
        return view('peminjam.index')->with('title','mulai pencatatan')->with('labor',$labor);
    }
    function pilihLabor(Request $request) {
        $labor = LaborKomputer::findOrFail($request->labor);
        // dd(count($labor->komputer));
        if (count($labor->komputer)>0) {
            $komputer = $labor->komputer;
            return view('peminjam.index')->with('title', 'mulai pencatatan')->with('komputer', $komputer);
        } else {
            $komputer = [];
            return view('peminjam.index')->with('title', 'mulai pencatatan')->with('komputer', $komputer);
        }
        
    }
    function mulaiPencatatan(Request $request) {
        $komputer = Komputer::find($request->komputer);
        $pemakaian = new Pemakaian();
        $pemakaian->user_id = Auth()->user()->id;
        $pemakaian->labor_komputer_id = $komputer->labor->id;
        $pemakaian->komputer_id = $komputer->id;
        $pemakaian->start = now();
        $pemakaian->save();
        return redirect()->route('peminjam.viewStop');
    }
    function stopPencatatanView() {
        $catatan = Pemakaian::where('user_id',Auth()->user()->id)->whereNull('end')->get();
        // dd($catatan);
        return view('peminjam.stop')->with('title','stop pencatatan')->with('catatan',$catatan);
    }
    function stopPencatatan(Request $request) {
        $catatan = Pemakaian::find($request->id);
        $catatan->end = now();
        $catatan->save();
        return redirect()->route('home');
    }
}
