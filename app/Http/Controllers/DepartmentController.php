<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Users;
use Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Department::all();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data

            ]);
            
    }

    public function getDepartmentUsers($id)
    {
        $data = Users::where('department_id', $id)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data

            ]);
            
    }

    public function getDepartmentJabatan($id)
    {
        $data = Users::where('department_id', $id)->get();

        return response()->json([
            'code' => 200,
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
            'nama' => 'required|string|unique:departments'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.'           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }
        $department           = new Department;
        $department->nama = $request->nama;
        $department->save();
       
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $department
            ]);
        /*$this->validate($request, [
            'nama' => 'required | unique:departments'
        ]);

        $data=[
            'nama' => $request->input('nama')
        ];

        $department = Department::create($request->all());

        if ($department) {
            $result = [
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        } else {
            $result = [
                'code' => 400,
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department =  Department::find($id);

        $data = Department::where('id',$id)->get();
        
        if (!$department) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                'data' => ''
            ];
        } else {
            $department->get();
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $data
            ];
        }

        return response()->json($result);
        /*$data = Department::where('id',$id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data
            ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        return response()->json("ini update");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $department =  Department::find($id);
            //$department->nama = $request->nama;
            //$department->save();

            if (!$department) {
                return response()->json([
                    'code' => 404,
                    'message' => 'id not found',
                    'data' => '']);
            }

        $rules = [
            'nama' => 'required|string|unique:departments'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.'           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }
            $department->update($request->all());
                
                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $department
                    ]);
        
        

        

        /*$this->validate($request, [
            'nama' => 'required | unique:departments'
        ]);

        $data=[
            'nama' => $request->input('nama')
        ];

        $department = Department::where('id', $id)->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Success'
            ]);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department =  Department::find($id);
 
        if (!$department) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $department->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
        /*Department::where('id',$id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => ''
            ]);*/
    }
}
