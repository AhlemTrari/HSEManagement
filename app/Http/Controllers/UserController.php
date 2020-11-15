<?php

namespace App\Http\Controllers;

use App\User;
use App\Unite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $unites = Unite::all();

        return view('users.index')->with([
            'users' => $users,
            'unites' => $unites,
        ]);
    }
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $unite = Unite::find($request->input('unite_id'));
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->unite = $request->input('unite_id');
        $user->is_admin = $request->input('is_admin');
        $user->unitee()->associate($unite);
        $user->password = Hash::make($request->input('password'));
        // $unite->adresse = $request->input('adresse');
        $user->save();

        return back();
    }
}
