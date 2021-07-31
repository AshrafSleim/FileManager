<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use File;

class UserController extends Controller
{

    public function index()
    {
//        $userFolders=Auth::user()->folders;
        $userFolders=UserFolder::where('user_id',Auth::id())->where('idParentFolder',null)->get();
        session()->forget('menu');
        session()->put('menu', 'home');
        return view('admin.home',compact('userFolders'));
    }

    public function showUserRegisterForm()
    {
        return view('admin.register');
    }

    protected function createUser(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users,email','string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('home'));
        }
        return redirect()->back();
    }


    public function showUserLoginForm()
    {
        return view('admin.login');
    }

    protected function loginUser(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('home'));
        }
        flash('Message')->error();
        return back()->withInput($request->only('email'));
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('login'));
    }





}
