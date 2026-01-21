<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests\DashboardRequests;

class DashboardController extends Controller
{

    public function index(DashboardRequests $request){
        // $form = $request->validated();

        return view('dashboard.index');
    }
}
