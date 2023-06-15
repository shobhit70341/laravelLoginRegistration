<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'mobile' => ['required', 'string', 'max:255'],
            'profile_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'dimensions:min_width=400,min_height=400'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');

        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $imagePath = $image->store('profile_images', 'public');
            
            $resizedImage = Image::make(public_path('storage/' . $imagePath))
                ->fit(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 80); // Optionally, encode the image in JPEG format with 80% quality
            
            Storage::disk('public')->put($imagePath, $resizedImage);
            
            $user->profile_img = $imagePath;
        }


        $user->save();
        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
