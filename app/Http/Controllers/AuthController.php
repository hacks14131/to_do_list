<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function logout(Request $request) {
        
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('login');

    }
    public function login(Request $request) {

        $fields = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($fields)) {
            $request->session()->regenerate();
 
            return redirect()->route('all-tasks');
        }
 
        return back()->withErrors([
            'username' => 'The provided login credentials do not match our records.',
        ])->onlyInput('username');
    }
    public function register(Request $request) {
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'password' => ['required', 'confirmed', 'max:255'],
            'firstName' => ['required', 'max:255'],
            'middleName' => ['required', 'max:255'],
            'familyName' => ['required', 'max:255'],
            'role' => ['required', 'max:255'],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
                'dimensions:min_width=100,min_height=100'
            ],
        ]);
        
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $fields['avatar'] = $avatarPath;
        }
        
        $newUser = User::create($fields);

        // Auth::login($newUser);

        return redirect()->route('all-tasks');
    }
}
