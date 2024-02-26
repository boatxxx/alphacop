<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CssSetting;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Company;



class CssSettingcontroller extends Controller
{
    public function index()
    {

        $customCSS = CssSetting::latest()->first(); // ตั้งค่าด้วย ID ที่เลือกเป็นตัวอย่าง
        return view('css_settings', ['customCSS' => $customCSS]);
    }

    public function app()
    {

        $customCSS = CssSetting::latest()->first(); // ตั้งค่าด้วย ID ที่เลือกเป็นตัวอย่าง
        return view('layouts.app', ['customCSS' => $customCSS]);
    }
    public function store (Request $request)
    {
        $request->validate([
            'background_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_color' => 'required|string|max:255',
            'table_border_color' => 'required|string|max:255',
            'font_size' => 'required|integer',
        ], [
            'background_image.image' => 'Please upload a valid image file',
            'background_image.mimes' => 'Supported image formats: jpeg, png, jpg, gif',
            'background_image.max' => 'Maximum file size allowed is 2048 KB',
            'background_color.required' => 'Background color is required',
            'table_border_color.required' => 'Table border color is required',
            'font_size.required' => 'Font size is required',
            'font_size.integer' => 'Font size must be an integer value',
        ]);

        $cssSetting = new CssSetting();

        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $imagePath = $image->store('public/background_images');
            $imageName = basename($imagePath);

            $cssSetting->background_image = $imageName; // กำหนดชื่อไฟล์ในอ็อบเจกต์ของ CssSetting
        }

        $cssSetting->background_color = $request->input('background_color');
        $cssSetting->table_border_color = $request->input('table_border_color');
        $cssSetting->font_size = $request->input('font_size');

        $cssSetting->save();


        return redirect()->route('csssettings')->with('success', 'CSS settings have been saved successfully.');


    }
}


