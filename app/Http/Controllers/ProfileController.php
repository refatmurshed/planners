<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
    public function basicUpdate(Request $request)
{
    $request->validate([
        'phone'       => 'nullable|string|max:50',
        'address'     => 'nullable|string|max:255',
        'description' => 'nullable|string|max:1000',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $user = auth()->user();

    // নিশ্চিত member row থাকবে
    $member = \App\Models\Member::firstOrNew([
        'user_id' => $user->id
    ]);

    // IMAGE UPDATE
    if ($request->hasFile('image')) {

        if (!empty($member->image) && file_exists(public_path($member->image))) {
            @unlink(public_path($member->image));
        }

        $file = $request->file('image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('uploads/members'), $fileName);

        $member->image = 'uploads/members/' . $fileName;
    }

    // DATA UPDATE
    $member->phone = $request->phone;
    $member->address = $request->address;
    $member->description = $request->description;

    // safety default
    if (!$member->joining_date) {
        $member->joining_date = now();
    }

    $member->user_id = $user->id;

    $member->save();

    return redirect()
        ->back()
        ->with('success', 'Basic information updated successfully!');
}




    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
