<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Authorization']);
    }

    public function login(LoginRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->route('admin');
        }

        return back();
    }

}
