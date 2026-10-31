<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request) {
        request()->validate([ // можно доделать валидатион мейби
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'login' => 'required|unique:users',
            'rules' => 'required',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->patronymic = $request->patronymic;
        $user->password = md5($request->password);
        $user->email = $request->email;

        $user->save();

        return redirect()->route('auth');
    }
    public function login(Request $request) {
        $user = User::query()->where('login', $request->login)->where('password', md5($request->password))->first();
        if ($user->is_admin == 1) {
            return redirect()->route('admin.index');
        }
        if (!$user) {
            return redirect()->back()->with('error', 'Неверный логин или пароль');
        }
        return redirect()->route('welcome');
    }
}
