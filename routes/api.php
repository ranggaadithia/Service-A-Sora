<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/users', function (Request $request) {
    $emails = User::pluck('email'); // hanya ambil kolom email
    return response()->json($emails);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return response()->json(['message' => 'Login successful', 'authenticate' => true, 'user' => Auth::user(),]);
    }

    return response()->json(['message' => 'Unauthorize', 'authenticate' => false], 403);
});
