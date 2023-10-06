<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function dashboard()
    {
        $users = \App\Models\User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function index()
    {
        $users = \App\Models\User::all();
        return view('admin.businesses.index', ['users' => $users]);
    }
}