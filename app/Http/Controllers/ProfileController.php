<?php

namespace App\Http\Controllers;


use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('app.profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',

        ]);

        $user = auth()->user();

        if ($user->name != trim($request->name)) {
            $text = ucwords($user->name) . ' updated his profile name from ' . $user->name . " to " . $request->name . ", datetime :   " . now();
        } else {
            $text = ucwords($user->name) . ' updated his profile, datetime: ' . now();
        }



        $user->update([
            'name' => trim($request->name),
            'email' => trim($request->email),


        ]);

        Log::create([
            'text' => $text,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function save_password(Request $request)
    {
        $request->validate([
            'new_password' => 'required|max:255|confirmed',
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make(
                $request->new_password
            )
        ]);

        Log::create([
            'text' => ucwords($user->name) . ' changed his password, datetime: ' . now(),
        ]);

        return redirect()->back()->with('success', 'Password Changed Successfully...');
    }

}
