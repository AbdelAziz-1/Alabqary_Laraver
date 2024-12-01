<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('general.setting.setting', compact('settings'));
    }

    public function create()
    {
        return view('general.setting.setting');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            'socialLink1' => 'nullable|url',
            'socialLink2' => 'nullable|url',
            'socialLink3' => 'nullable|url',
            'socialLink4' => 'nullable|url',
        ]);

        Setting::create($request->all());
        return redirect()->route('settings.index')->with('success', 'Setting created successfully!');
    }

    public function edit(Setting $setting)
    {
        return view('general.setting.setting', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'phone' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            'socialLink1' => 'nullable|url',
            'socialLink2' => 'nullable|url',
            'socialLink3' => 'nullable|url',
            'socialLink4' => 'nullable|url',
        ]);

        $setting->update($request->all());
        return redirect()->route('settings.index')->with('success', 'Setting updated successfully!');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully!');
    }
}
