<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.systemSettings', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp'        => ['required', 'string', 'max:20'],
            'email'        => ['required', 'email', 'max:255'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'name'  => $request->nama_lengkap,
            'phone' => $request->no_hp,
            'email' => $request->email,
        ]);

        return back()->with('success', true);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(12)->mixedCase()->numbers()->symbols()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', true);
    }
}
