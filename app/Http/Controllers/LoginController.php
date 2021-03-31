<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //
    public function register(Request $request)
    {
        $data = [
            'username' =>$request->input('username'),
            'password' =>Hash::make($request->input('password')),
            'department_id'     => $request->input('department_id'),
            'jabatan_id' => $request->input('jabatan_id'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'email'    => $request->input('email'),
            'telp' => $request->input('telp'),
            'api_token' => ''
        ];

        $register = Users::create($data);

        if ($register){
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $register
            ]);
    }else{
        return response()-> json([
            'code' => 200,
            'message' => 'failed',
            'data' => ''
        ]);
    }
    }

    public function login(Request $request)
    {
            $username = $request->input('username');
            $password = $request->input('password');

            $users = Users::where('username', $username)->first();

            if (Hash::check($password, $users->password)) {
                $token = Str::random(10);

                $users->update([
                    'api_token' => $token
                ]);

                return response()->json([
                    'code' => 200,
                    'message' => 'Login success',
                    'data' => [
                        'users' => $users,
                        'api_token' => $token
                    ]
                ]);
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'Login failed',
                    'data' => ''
                ]);
            }
    }
}
