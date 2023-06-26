<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Gudang;
use App\Models\User;
use App\Models\Part;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {

        $user = User::all()->count();
        $gudang = 2;
        $part = 2;
        return view('superadmin.dashboard.index', compact('user', 'gudang', 'part'));
    }
}
