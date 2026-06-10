<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function apiIndex()
    {
        return response()->json(\App\Models\Author::all(), 200);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string']);
        $author = \App\Models\Author::create($validated);
        return response()->json(['message' => 'បង្កើតអ្នកនិពន្ធជោគជ័យ!', 'author' => $author], 21);
    }

    // បង្ហាញទំព័រ Register (Web UI)
    public function showRegister()
    {
        return view('auth.register');  // ផ្ទៀងផ្ទាត់ឈ្មោះ folder/file view របស់អ្នក
    }

    // បង្ហាញទំព័រ Login (Web UI)
    public function showLogin()
    {
        return view('auth.login');  // ផ្ទៀងផ្ទាត់ឈ្មោះ folder/file view របស់អ្នក
    }

    // 🌟 ១. សម្រាប់ចុះឈ្មោះតាម Web UI (បង្ខំឱ្យធ្វើជាបុគ្គលិក 'staff' ទាំងអស់)

    public function webRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $staffRole = \App\Models\Role::where('name', 'staff')->first();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $staffRole ? $staffRole->id : 2
        ]);

        Auth::login($user);

        return redirect()->route('store.public')->with('success', 'បង្កើតគណនីជោគជ័យ!');
    }

    public function apiRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }

    // សម្រាប់ Web Login

    public function webLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔍 ពិនិត្យមើលតួនាទី (Role) របស់គណនីដែលបានចូលប្រព័ន្ធ
            $user = Auth::user();

            if ($user->role && $user->role->name === 'admin') {
                // បើជា Admin ឱ្យទៅទំព័រគ្រប់គ្រងសៀវភៅ (Backend Dashboard)
                return redirect()->route('books.ui');
            } else {
                // បើជា Simple User (staff) ឱ្យទៅទំព័រហាងលក់សៀវភៅ (user_index)
                return redirect()->route('store.public');
            }
        }

        return back()->withErrors([
            'email' => 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវឡើយ។',
        ]);
    }

    // សម្រាប់ Web Logout
    public function webLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // សម្រាប់ API Login
    public function apiLogin(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }
}
