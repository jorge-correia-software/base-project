<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $groups = [
            'general' => Setting::where('group', 'general')->get(),
            'seo' => Setting::where('group', 'seo')->get(),
            'social' => Setting::where('group', 'social')->get(),
            'contact' => Setting::where('group', 'contact')->get(),
        ];

        return view('admin.settings.index', compact('groups'));
    }

    public function group($group)
    {
        $settings = Setting::where('group', $group)->get();
        return view('admin.settings.group', compact('settings', 'group'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully');
    }
}
