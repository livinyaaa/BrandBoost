<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'role' => 'required|integer|between:0,1',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->password = bcrypt('pass123');
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',

        ]);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
            ]);


        return redirect()->back()->with('success', 'User updated successfully.'); // Redirect back with a success message 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Had to access the table directly because deleting the model was not deleting it from the database
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }
}