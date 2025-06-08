<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function addNewUser(Request $request) {
        sleep(1);
        $request->validate([
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
                'max:2048', // 2MB
                'dimensions:min_width=100,min_height=100'
            ],
        ]);
    }
}
