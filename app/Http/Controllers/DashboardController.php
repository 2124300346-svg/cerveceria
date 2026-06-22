<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $administrador = Auth::guard('admin')->user();

        if (!$administrador) {
            return redirect('/login');
        }

        return view('/dashboard', compact('administrador'));
    }
}