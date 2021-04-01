<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class LoginController extends Controller
{
    //
    public function register(Request $request)
    {
        // $data = [
        //     'username' =>$request->input('username'),
        //     'password' =>Hash::make($request->input('password')),
        //     'department_id'     => $request->input('department_id'),
        //     'jabatan_id' => $request->input('jabatan_id'),
        //     'nama' => $request->input('nama'),
        //     'alamat' => $request->input('alamat'),
        //     'email'    => $request->input('email'),
        //     'telp' => $request->input('telp'),
        //     'api_token' => ''
        // ];
        $rules = [
            'username' => 'required | unique:users',
            'password' => 'required | min:6',
            'department_id' => 'required | numeric',
            'jabatan_id' => 'required | numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'telp' => 'required|unique:users|numeric'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
            'password.min'      => 'Password minimal diisi dengan 6 karakter.',
            'email.email'       => 'Email tidak valid.',           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }

        $users           = new Users;
        $users->username = $request->username;
        $users->password = Hash::make($request->password);
        $users->department_id     = $request->department_id;
        $users->jabatan_id = $request->jabatan_id;
        $users->nama = $request->nama;
        $users->alamat = $request->alamat;
        $users->email    = $request->email;
        $users->telp = $request->telp;
        $users->save();

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $users
            ]);
    
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
