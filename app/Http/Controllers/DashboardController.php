<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        return view('welcome');
    }
}
