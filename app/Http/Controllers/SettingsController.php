<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    // view page
    public function view_subs_settings()
    {
        $settings = Setting::first();
        return view('admin.settings.subscription_settings', compact('settings'));
    }

    // edit page
    public function edit_subs_settings()
    {
        $settings = Setting::first();
        return view('admin.settings.subscription_settings_edit', compact('settings'));
    }

    // update data
    public function update_subs_settings(Request $request)
    {
        $request->validate([
            'subscription_amount' => 'required|numeric',
            'due_day' => 'required|integer|min:1|max:31',
        ]);

        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting();
        }

        $settings->subscription_amount = $request->subscription_amount;
        $settings->due_day = $request->due_day;
        $settings->save();

        return redirect()->route('admin.subscription.settings')
            ->with('success', 'Settings updated successfully');
    }
}
