<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Image;

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
        $request->user()->fill($request->safe()->except(['photo']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->file('photo')) {
            if ($request->user()->photo) {
                Storage::disk('cloudinary')->delete($request->user()->photo);
            }
            $file = $request->file('photo');
            $filename = time().'-'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_path = 'profile_images/'.$filename;

            $image = Image::make($file)->resize(250, 250)->encode('data-url');

            $result = cloudinary()->uploadFile($image, [
                'public_id' => $upload_path,
            ]);

            $request->user()->photo = $result->getPublicId();
        }

        $request->user()->save();

        $notification = [
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        ];

        return Redirect::route('profile.edit')->with($notification);
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
