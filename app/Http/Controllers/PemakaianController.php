<?php

namespace App\Http\Controllers;

use App\Models\LaborKomputer;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    function index() {
        $labor = LaborKomputer::all();
        return view('peminjam.index')->with('title','mulai pencatatan')->with('labor',$labor);
    }
}
