<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function edit()
    {
        $about = Setting::group('about', config('about'));

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $rules = [
            'intro_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_intro_image' => 'nullable|boolean',
        ];

        foreach (array_keys(config('about')) as $key) {
            if ($key !== 'intro_image') {
                $rules[$key] = 'nullable|string|max:20000';
            }
        }

        $validated = $request->validate($rules);
        $current = Setting::group('about');

        $values = collect($validated)
            ->except(['intro_image_file', 'remove_intro_image'])
            ->map(fn ($value) => is_string($value) ? trim($value) : $value)
            ->all();

        $storedImage = $current['intro_image'] ?? null;
        $isUploadedImage = $storedImage && !Str::startsWith($storedImage, ['http://', 'https://']);

        if ($request->hasFile('intro_image_file')) {
            if ($isUploadedImage) {
                Storage::disk('public')->delete($storedImage);
            }
            $values['intro_image'] = $request->file('intro_image_file')->store('about', 'public');
        } elseif ($request->boolean('remove_intro_image') && $isUploadedImage) {
            Storage::disk('public')->delete($storedImage);
            $values['intro_image'] = null;
        }

        Setting::saveGroup('about', $values);

        return redirect()->route('admin.about.edit')->with('success', 'About page updated successfully.');
    }
}
