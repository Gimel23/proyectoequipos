<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $equipos = Auth::user()->equipos;
        return view('dashboard', compact('equipos'));
    }
}
