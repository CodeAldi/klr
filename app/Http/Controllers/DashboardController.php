<?php

namespace App\Http\Controllers;

use App\Models\LaborKomputer;

class DashboardController extends Controller
{
    function index() {
        if(Auth()->user()->hasRole('Peminjam')){
            $labor = LaborKomputer::all();
        return view('welcome')->with('title','pilih labor')->with('labor',$labor);
        }
        return view('welcome')->with('title','Home');
    }
}
