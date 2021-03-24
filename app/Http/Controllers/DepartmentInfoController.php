<?php

namespace App\Http\Controllers;

use App\Models\DepartmentInfo;
use Illuminate\Http\Request;

class DepartmentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Department::all();
        //
        return Users::find('id', $id)->users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\DepartmentInfo  $departmentInfo
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentInfo $departmentInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentInfo  $departmentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentInfo $departmentInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentInfo  $departmentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentInfo $departmentInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentInfo  $departmentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentInfo $departmentInfo)
    {
        //
    }
}
