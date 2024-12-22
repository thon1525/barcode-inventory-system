<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Enums\ProfileTabs;

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
    public function logout(Request $request): RedirectResponse
    {


        Auth::logout();



        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('profile.profile_view', compact('profileData'));
    }

    public function profile_store(Request $request)
    {
        $id = Auth::user()->id;
        $Data = User::find($id);
        $Data->username = $request->username;
        $Data->name = $request->name;
        $Data->email = $request->email;
        $Data->phone = $request->phone;
        $Data->address = $request->address;
        $Data->company = $request->company;
        $Data->about = $request->about;

        if ($request->file('avatar')) {
            $image_path = public_path('upload/profile_pictures/') . $Data->avatar;

            if (file_exists($image_path)) {

                @unlink($image_path);
            }
            $file = $request->file('avatar');

            $filename = date('YmuidHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/profile_pictures'), $filename);
            $Data['avatar'] = $filename;
        }

        $Data->save();
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|min:8|confirmed', // confirm that 'newpassword' matches 'renewpassword'
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Current password does not match.']);
        }

        // Update the password
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->back()->with('status', 'Password changed successfully!');
    }
}
