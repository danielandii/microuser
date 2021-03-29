<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Jabatan;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = Users::all();

        return response()->json([
        'Code' => 200,
        'message' => 'Success',
        'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'username' => 'required | unique:users',
            'password' => 'required | min:6',
            'department_id' => 'required | numeric',
            'jabatan_id' => 'required | numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'telp' => 'required|unique:users|numeric',
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
            'message' => 'Success',
            'data' => $users
            ]);
    
        //
        /*$this->validate($request, [
            'username' => 'required | unique:users',
            'password' => 'required',
            'department_id' => 'required | numeric',
            'jabatan_id' => 'required | numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'email:rfc,dns',
            'telp' => 'required | numeric',
        ],
        [
            'email.unique' => 'Email sudah terdaftar, input email lain',
            'telp.unique' => 'Nomor Telpon sudah terdaftar, input nomor lain',
            'username.unique' => 'Username sudah terdaftar'
            ]);

        $data=[
            'username' => $request->input('username'),
            'password' => Hash::make('password'),
            'department_id' => $request->input('department_id'),
            'jabatan_id' => $request->input('jabatan_id'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
        ];

        $users = Users::create($request->all());

        if ($users) {
            $result = [
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        } else {
            $result = [
                'Code' => 400,
                'message' => 'Failed',
                'data' => ''
            ];
        }
        

        return response()->json($result);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users =  Users::find($id);

        $data = Users::where('id',$id)->get();
        
        if (!$users) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                'data' => ''
            ];
        } else {
            $users->get();
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $data
            ];
        }

        return response()->json($result);
        /*$data = Users::where('id',$id)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success ',
            'data' => $data]);*/
        }
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $users =  Users::find($id);
        //$department->nama = $request->nama;
        //$department->save();

        if (!$users) {
            return response()->json([
                'code' => 404,
                'message' => 'id not found',
                'data' => '']);
        }

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
            'email.email'       => 'Email tidak valid.'           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }
        
        $users->username = $request->username;
        $users->password = Hash::make($request->password);
        $users->department_id     = $request->department_id;
        $users->jabatan_id = $request->jabatan_id;
        $users->nama = $request->nama;
        $users->alamat = $request->alamat;
        $users->email    = $request->email;
        $users->telp = $request->telp;
        $users->update($request->all());
        //$department->save();
       
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $users
            ]);
        /*$this->validate($request, [
            'username' => 'required | unique:users',
            'password' => 'required',
            'department_id' => 'required | numeric',
            'jabatan_id' => 'required | numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'email:rfc,dns',
            'telp' => 'required | numeric',
        ],
        [
            'email.unique' => 'Email sudah terdaftar, input email lain',
            'telp.unique' => 'Nomor Telpon sudah terdaftar, input nomor lain',
            'username.unique' => 'Username sudah terdaftar'
            ]);
        $data = Users::where('id', $id)->update($request->all());
        //$users = Users::where('id', $id)->first();

        return response()->json([
            'code' => 200,
            'message' => 'Success'
            ]);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users =  Users::find($id);
 
        if (!$users) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $users->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
        /*Users::where('id',$id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => ''
            ]);*/
    }
}
