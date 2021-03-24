<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Users;

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
        $this->validate($request, [
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Department::where('id',$id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Tampilan data ke ',
            'data' => $data
            ]);
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
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'nama' => 'required | unique:departments'
        ]);

        $data=[
            'nama' => $request->input('nama')
        ];

        $department = Department::where('id', $id)->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('id',$id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => ''
            ]);
    }
}
