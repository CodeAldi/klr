<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use App\Models\LaborKomputer;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $base64 = "data:image/png;base64," . base64_encode(file_get_contents($request->file('wajah')->path()));
        // cek apakah wajah sesuai dengan user id

        // start Face recognation
        $respone = Http::withHeaders(['Accesstoken' => env('BIZNET_TOKEN')])
        ->post(env('BIZNET_ENDPOINT') . '/risetai/face-api/facegallery/identify-face',[
            "facegallery_id" => env('BIZNET_FG'),
            "image" => $base64 ,
            "trx_id" => env('BIZNET_TRX_ID'),
        ]);
        dd($respone->json(['risetai']));
        // end face recognation
        if (($respone->json('risetai')['status']) == 200) {
            $komputer = Komputer::find($request->komputer);
            $pemakaian = new Pemakaian();
            $pemakaian->user_id = Auth()->user()->id;
            $pemakaian->labor_komputer_id = $komputer->labor->id;
            $pemakaian->komputer_id = $komputer->id;
            $pemakaian->start = now();
            $pemakaian->save();
            return redirect()->route('peminjam.viewStop');
            # code...
        }
        else {
            return redirect()->route('home');
            
        }
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
