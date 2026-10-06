<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // 🔴 STEP 1: status check
if (auth()->user()->status == 0) {
    auth()->logout();
    return redirect('/')->with('error', 'Your account is not approved yet. After Admin approval you can enter to your dashboard');
}

// 🟢 STEP 2: role check
if (auth()->user()->role == 1) {
    return redirect('/admin/dashboard');
}

// 🟢 STEP 3: default (member)
return redirect('/member/dashboard');

        return redirect('/')->with('success', '');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
