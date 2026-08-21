<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Nieuwe gebruiker is succesvol aangemaakt.');
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
    public function edit(User $user)
    {
        return view("admin.users.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:user,admin'],
        ]);

        if($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Je kan je eigen rol niet veranderen.');
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Gebruiker is succesvol geupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()){
            return redirect()->route("admin.users.index")->with("error","Je kan je eigen account niet verwijderen");
        }
        $user->delete();

        return redirect()->route("admin.users.index")->with("success","Gebruiker is succesvol verwijderd");
    }


    public function changeRole(User $user)
    {
        // Prevent admin from changing their own role
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Je kan je eigen admin rol niet aanpassen.');
        }

        // Allow admin to change other users' roles
        $user->update([
            'role' => $user->role === 'admin' ? 'user' : 'admin'
        ]);

        return redirect()->back()->with('success', 'Je hebt de rol van de user aangepast.');
    }
}
