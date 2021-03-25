<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Jabatan::all();

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
            'department_id' => 'required',
            'nama' => 'required | unique:jabatans'
        ]);

        $data=[
            'department_id' => $request->input('department_id'),
            'nama' => $request->input('nama')
        ];

        $jabatan = Jabatan::create($request->all());

        if ($jabatan) {
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        //$jabatan = Jabatan::where('id',$id)->get();
        $jabatan =  Jabatan::find($id);

        $data = Jabatan::where('id',$id)->get();
        
        if (!$jabatan) {
            $result = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $jabatan->get();
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $data
            ];
        }

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
            'department_id' => 'required',
            'nama' => 'required | unique:jabatans'
        ]);

        $jabatan = Jabatan::where('id', $id)->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        /*Jabatan::where('id',$id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => ''
            ]);
    }*/
    $jabatan =  Jabatan::find($id);
 
        if (!$jabatan) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $jabatan->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
    }
}
