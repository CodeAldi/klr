<?php

namespace App\Http\Controllers;

use App\Models\LaborKomputer;
use Illuminate\Http\Request;

class LabKomController extends Controller
{
    function index() {
        $labKom = LaborKomputer::all();
        return view('admin.manajemenLabKom')
        ->with('labkom',$labKom)
        ->with('title','Manajemen Labor Komputer');
    }
    function store(Request $request) {
        $validatedData = $request->validate([
            'kodeLab'=> 'required',
            'namaLab'=> 'required',
            'lokasiLab'=> 'required',
            'kodeLab' => 'unique:labor_komputer,kodeLab',
        ]);
        $labKom = new LaborKomputer();
        $labKom->kodeLab = $validatedData['kodeLab'];
        $labKom->namaLab = $validatedData['namaLab'];
        $labKom->lokasiLab = $validatedData['lokasiLab'];
        $labKom->save();
        return back();
    }
    function update(Request $request) {
        $labkom = LaborKomputer::findOrFail($request->id);
        if($labkom->kodeLab != $request->kodeLab){
            $labkom->kodeLab = $request->kodeLab;
        }
        if($labkom->namaLab != $request->namaLab){
            $labkom->namaLab = $request->namaLab;
        }
        if($labkom->lokasiLab != $request->lokasiLab){
            $labkom->lokasiLab = $request->lokasiLab;
        }
        $labkom->save();
        return back();
        
    }
}
