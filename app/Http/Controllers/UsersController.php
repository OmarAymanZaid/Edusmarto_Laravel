<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('usersResource.index', ['users' => $users]);
    }

    public function show($userID)
    {
        $user = User::findOrFail($userID);

        $role = auth()->user()->roleID;
        if ($role == config('constants.role.ADMIN'))
            $userView = 'adminMain';
        
        elseif ($role == config('constants.role.STUDENT'))
            $userView = 'studentMain';

        elseif($role == config('constants.role.TEACHER'))
            $userView = 'teacherMain';

        return view('usersResource.show', ['user' => $user, 'userView' => $userView]);
    }

    public function create()
    {
        return view('usersResource.create');
    }

    public function store(Request $request)
    {
        $valid = $request ->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roleID'     => 'required|exists:roles,id'
        ]);

        User::create($valid);

        return to_route('user.index')->with('success', 'User created successfully !');
    }

    public function edit($userID)
    {
        $user = User::findOrFail($userID);
        return view('usersResource.edit', ['user' => $user]);
    }

public function update(Request $request, $userID)
{
    $user = User::findOrFail($userID);

    $valid = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $userID,
        'password' => 'required|string|min:8|confirmed',
        'roleID'   => 'required|exists:roles,id',
    ]);

    $user->name = $valid['name'];
    $user->email = $valid['email'];
    $user->password = $valid['password'];
    $user->roleID = $valid['roleID'];

    $user->save();

    return to_route('user.show', $userID)-> with('success', 'User Updated Successfully !');
}

    public function destroy($userID)
    {
        $user = User::findOrFail($userID);
        $user->delete();
        
        return to_route('user.index') ->with('success', 'User Deleted Successfully !');
    }

    public function showTeachers()
    {
        $teachers = User::where('roleID', config('constants.role.TEACHER'))->get();

        return view('usersResource.showTeachers', ['teachers' => $teachers]);
    }

    public function showFellowTeachers()
    {
        $teachers = User::where('roleID', config('constants.role.TEACHER'))->where('id', '!=', auth()->id())->get();

        return view('usersResource.showFellowTeachers', ['teachers' => $teachers]);
    }
}
