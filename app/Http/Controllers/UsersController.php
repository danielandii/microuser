<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Department;

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
        //
        $this->validate($request, [
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
            'password' => $request->input('password'),
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
                'Code' => 200,
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
        

        return response()->json($result);
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
        $data = Users::where('id',$id)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success ',
            'data' => $data
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
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
        $this->validate($request, [
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
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Users::where('id',$id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => ''
            ]);
    }
}
