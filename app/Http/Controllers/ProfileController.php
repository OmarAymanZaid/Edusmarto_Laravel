<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
        public function showProfile()
    {
        return view('usersResource.userProfile');
    }

    public function changeProfileImage(Request $request)
    {
        $valid = $request ->validate([
            'photo'          => 'required|image',
        ]);

        if($request ->hasFile('photo'))
        {
            $photoPath = $request->file('photo')->store('images','public');
            $user = auth()->user();
            $user ->photo = $photoPath;
            $user ->save();
        }

        return to_route('user.profile')-> with('success', 'Image Changed Successfully!');
    }

    public function changeProfileName(Request $request)
    {
        $valid = $request -> validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user ->name = $valid['name'];
        $user ->save();

        return to_route('user.profile')-> with('success', 'Name Changed Successfully!');

    }
}
