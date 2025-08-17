<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AdminIndex(Request $request){
        return view('Admin.AdminDashboard');
    }
}
