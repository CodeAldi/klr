<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use Illuminate\Http\Request;

class KomputerController extends Controller
{
    function index() {
        $labor_id = Auth()->user()->assignment[0]->labkom->id;
        $komputer = Komputer::where('labor_komputer_id',$labor_id)->get();
        return view('teknisi.managementKomputer')->with('title','Management Komputer')->with('komputer',$komputer);
    }
    function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);
        if (count(Auth()->user()->assignment) == 0) {
            return back();
        }
        $labor_id = Auth()->user()->assignment[0]->labkom->id;
        $komputer = new Komputer();
        $komputer->nama = $validatedData['nama'];
        $komputer->labor_komputer_id = $labor_id;
        $komputer->save();
        return back();
    }
    function update(Request $request)
    {
        $komputer = Komputer::findOrFail($request->id);
        $komputer->nama = $request->nama;
        $komputer->save();

        return back();
    }
    function destroy(Komputer $komputer)
    {
        $komputer->delete();
        return back();
    }
    
}
