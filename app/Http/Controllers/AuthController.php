<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            $redirectUrl = route('dashboard');
            if ($user->role && strtolower($user->role->name) === 'admin') {
                $redirectUrl = route('admin.dashboard');
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect_url' => $redirectUrl
                ]);
            }

            return redirect()->to($redirectUrl);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
                'errors' => ['email' => ['Email atau password salah.']]
            ], 422);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = \App\Models\Role::where('name', 'Participant')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role ? $role->id : null, // Default to Participant
        ]);
        

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Selamat datang.',
                'redirect_url' => route('dashboard')
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
