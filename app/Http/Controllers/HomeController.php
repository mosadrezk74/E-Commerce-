<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function login(Request $request){
        $request->validate([
            'Email' => 'required|string|email',
            'PasswordHash' => 'required|string'
        ]);

        $user = User::where('Email', $request->Email)->first();

        if (!$user || !Hash::check($request->PasswordHash, $user->PasswordHash)) {
            return back()->with('status', 'Invalid login details');
        }
        return view('Website.login' , compact('user'));
    }
}
