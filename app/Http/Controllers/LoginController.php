<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('account', 'password');

        $validator = Validator::make($credentials,
        [
            'account' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$validator->fails()) {
            if (Auth::guard('member')->attempt($credentials)) {
                $user = Auth::guard('member')->user();
                Auth::guard('member')->login($user);

                return redirect('/');
            } else {
                return view('login', [
                    'message' => '帳號或密碼錯誤'
                ]);
            }
        } else {
            return view('login', [
                'message' => '請輸入帳號及密碼'
            ]);
        }
        
    }

}
