<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('profile.username', compact('user'));
    }

    public function edit($field)
    {
        $user = User::where('name', auth()->user()->name)->firstOrFail();
        return view('profile.edit', compact('user', 'field'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_name' => 'nullable|string|max:255',
            'new_email' => 'nullable|email|unique:users,email|max:255',
            'new_password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/',
            'new_password_confirmation' => 'nullable|string',
        ], [
            'new_password.regex' => 'La contraseña debe tener al menos 8 caracteres, incluyendo al menos una letra mayúscula y un símbolo.'
        ]);
    
        $user = User::where('name', auth()->user()->name)->firstOrFail();
        
        if ($request->has('new_name')) {
            $user->name = $request->new_name;
        }
    
        if ($request->has('new_email')) {
            $user->email = $request->new_email;
        }
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->storeAs('public/profiles', $user->id . '_' . time() . '.' . $request->photo->extension());
            $user->photo = 'storage/' . str_replace('public/', '', $path);
        }
    
        $user->save();
    
        return redirect()->route('profile.username')->with('success', 'Perfil actualizado exitosamente');
    }
}