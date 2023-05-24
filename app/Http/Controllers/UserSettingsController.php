<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Auth;
use Hash;

class UserSettingsController extends Controller
{
    public function edit(Request $request) {
        $user = User::find(Auth::user()->id);

        if ($user == null) {
            return abort(404, 'User Not Found.');
        }

        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'max:255', 'email', 'unique:users'],
        ]);

        if ($request->input('name') !== null) {
            $user->name = $request->input('name');
        }

        if ($request->input('email') !== null) {
            $user->email = $request->input('email');
        }

        $user->save();
        toastr()->success('Settings edited successfully.');
        return redirect()->route('user.settings.index');
    }

    public function password(Request $request) {
        $user = User::find(Auth::user()->id);

        if ($user == null) {
            return abort(404, 'User Not Found.');
        }

        $validated = $request->validate([
            'password' => ['string', 'current_password'],
            'newPassword' => ['string', 'confirmed'],
        ]);

        $user->password = Hash::make($request->input('newPassword'));

        $user->save();
        toastr()->success('Password edited successfully.');
        return redirect()->route('user.settings.index');
    }
}
