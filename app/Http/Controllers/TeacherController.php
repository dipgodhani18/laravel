<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class TeacherController extends Controller
{
    public function showRegisterForm()
    {
        return view('teacher.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Teacher::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('teacher')->login($teacher);
        return redirect(route('teacher.dashboard', absolute: false));
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('teacher')->attempt($credentials, $remember)) {
            return redirect()->route('teacher.dashboard');
        };
        return back()->with('message', 'Invalid Credentials')->withInput($request->except('password'));
    }
}