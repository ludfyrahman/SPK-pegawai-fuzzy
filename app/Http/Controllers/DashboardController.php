<?php

namespace App\Http\Controllers;
use App\Models\Criteria;
use App\Models\Employee;
use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {

        $user = User::all()->count();
        $employee = Employee::all()->count();
        $position = Position::all()->count();
        $criteria = Criteria::all()->count();
        $user_id = auth()->user()->id;
        // dd($user_id);
        $data = Employee::with(['position', 'position.position'])->where('user_id', $user_id)->first();
        return view('superadmin.dashboard.index', compact('user', 'employee', 'position', 'criteria', 'data'));
    }
}
