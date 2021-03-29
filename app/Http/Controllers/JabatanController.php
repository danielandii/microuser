<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Validator;

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
        $rules = [
            'department_id' => 'required | numeric',
            'nama' => 'required|string|unique:jabatans'
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
        $jabatan           = new Jabatan;
        $jabatan->department_id     = $request->department_id;
        $jabatan->nama = $request->nama;
        $jabatan->save();
       
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $jabatan
            ]);
        /*$this->validate($request, [
            'department_id' => 'required',
            'nama' => 'required | unique:jabatans'
        ],
        [
            'nama.unique' => 'nama sudah terdaftar, input nama lain'
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //$jabatan = Jabatan::where('id',$id)->get();
        $jabatan =  Jabatan::find($id);

        $data = Jabatan::where('id',$id)->get();
        
        if (!$jabatan) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                'data' => ''
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
        $jabatan =  Jabatan::find($id);
            //$department->nama = $request->nama;
            //$department->save();

            if (!$jabatan) {
                return response()->json([
                    'code' => 404,
                    'message' => 'id not found',
                    'data' => '']);
            }

        $rules = [
            'department_id' => 'required',
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
            $jabatan->update($request->all());
                
                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $jabatan
                    ]);
        /*$this->validate($request, [
            'department_id' => 'required',
            'nama' => 'required | unique:jabatans'
        ]);

        $jabatan = Jabatan::where('id', $id)->update($request->all());

        $data =[
            'department_id' => $request->input('department_id'),
            'nama' => $request->input('nama')
        ];

        if (!$jabatan) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                'data' => ''
            ];
        } else {
            $jabatan->get();
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $data
            ];
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $jabatan
            ]);*/
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
