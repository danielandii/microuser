<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
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

        // $response = $users->createToken('users')->accessToken;

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $users
            // 'token' => $response
            ]);
    
    }

    public function login(Request $request)
    {
        // $username = $request->username;
        // $password = $request->password;

        // // check if field is not empty
        // if(empty($username) OR empty($password)) {
        //     return response()->json([
        //                 'code' => 400,
        //                 'message' => 'Failed'
        //             ]);
        // }

        // $client = new Client();

        // try {
        //     return $client->post('http://lumen-rest-api.test/v1/oauth/token', [
        //         "form_params" => [
        //             "client_secret" => "8Edy0KHCp2UWbpoCuKXsJaKwR7O6ZE3qu3SoLpRq",
        //             "grant_type" => "password",
        //             "client_id" => 2,
        //             "username" => $request->username,
        //             "password" => $request->password
        //         ]
        //     ]);
        // } catch (BadResponseException $e) {
        //     return response()->json([
        //         'code' => 400,
        //         'message' => $e->getMessage()
        //     ]);
        // }

            $username = $request->input('username');
            $password = $request->input('password');

            $users = Users::where('username', $username)->first();

            if (Hash::check($password, $users->password)) {
                $token = $users->createToken('users')->accessToken;

                return response()->json([
                    'code' => 200,
                    'message' => 'Login success',
                    'data' => [
                        'users' => $users,
                        'token' => $token
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
    public function logout(Request $request)
    {
        // if (Users::check()) {
        //     Users::users()->token()->revoke();
        //     return response()->json(['success' =>'logout_success'],200); 
        // }else{
        //     return response()->json(['error' =>'api.something_went_wrong'], 500);
        // }
        try {
            auth()->users()->tokens()->each(function ($token){
                            $token->delete();
                        });
            
        return response()->json([
                            'code' => 200,
                            'message' => 'success'
                        ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 401,
                'message' => $e->getMessage()
            ]);
        }
    //     try {
    //         auth()->users()->tokens()->each(function ($token){
    //             $token->delete();
    //         });

    //         return response()->json($data, 200, $headers);
    //     }
    }
}
