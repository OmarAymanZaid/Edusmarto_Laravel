<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }


    public function register(Request $request)
    {
        $valid = $request ->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roleID'     => 'required|exists:roles,id'
        ]);

        $user = User::create($valid);

        Auth::login($user);

        return $this->redirectToRoleDashboard();
    }

    
    public function login(Request $request)
    {
        $valid = $request ->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($valid))
        {
            $request->  session()->regenerate();

            return $this->redirectToRoleDashboard();
        }

        throw ValidationException::withMessages([
            'credentials' => 'Invalid credentials'
        ]);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerate();

        return to_route('login.show');
    }

    public function redirectToRoleDashboard()
    {
        if(Auth::user()->roleID == config('constants.role.ADMIN'))
        {
            return to_route('user.index');
        }
        else if(Auth::user()->roleID == config('constants.role.STUDENT'))
        {
            return to_route('courses.enrolledCourses');
        }
        else if(Auth::user()->roleID == config('constants.role.TEACHER'))
        {
            return to_route('courses.assignedCourses');
        }
    }

}
