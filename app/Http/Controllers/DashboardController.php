<?php

namespace App\Http\Controllers;

use App\Models\LaborKomputer;
use App\Models\Pemakaian;

class DashboardController extends Controller
{
    function index() {
        if(Auth()->user()->hasRole('Peminjam')){
            $catatan = Pemakaian::where('user_id',Auth()->user()->id)->whereNull('end')->count();
            if ($catatan>0) {
                return redirect()->route('peminjam.viewStop');
            } else {
                $labor = LaborKomputer::has('komputer')->get();
                return view('welcome')->with('title','pilih labor')->with('labor',$labor);
            }
            
        }
        return view('welcome')->with('title','Home');
    }
}
