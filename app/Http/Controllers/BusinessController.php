<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BusinessController extends Controller
{
    public function dashboard() {
        $promotions = Auth::user()->promotions;  // i have set up a one-to-many relationship between user and promotion
        return view('business.dashboard', compact('promotions'));
    }
    public function index()
    {
        $businesses = Business::all();
        return view('admin.businesses.index', ['businesses' => $businesses]);
    }

}