<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class Api_barang extends Controller
{
    // api barang
    public function index(Request $request){
    
        $find = !$request->query('find') ? null : $request->query('find');
        $all  = !$request->query('all') ? null : $request->query('all');


        if(!$find){
            $data = Barang::paginate(9);
        }else{
            if($all){
                $data = Barang::all();
            }else{
                $data = Barang::where('NAMA_BARANG', 'LIKE', '%'.$find.'%')->paginate(9);
            }
        }
       

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Barang',
            'data'    => $data  
        ], 200);
    }

    public function show($id)
    {
        $data = Barang::findOrfail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Barang',
            'data'    => $data 
        ], 200);
    }

    public function store(Request $request)
    {
        //set validation
        // add validation barang 1444
        $validator = Validator::make($request->all(), [
            'NAMA_BARANG' => 'required',
            'KATEGORI'    => 'required',
            'HARGA'       => 'required',
            'KETERANGAN'  => 'required'
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $data = Barang::create([
            'NAMA_BARANG' => $request->NAMA_BARANG,
            'KATEGORI'    => $request->KATEGORI,
            'HARGA'       => $request->HARGA,
            'KETERANGAN'  => $request->KETERANGAN
        ]);

        //success save to database
        if($data) {

            return response()->json([
                'success' => true,
                'message' => 'Barang Created',
                'data'    => $data  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);
    }

    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'NAMA_BARANG' => 'required',
            'KATEGORI'    => 'required',
            'HARGA'       => 'required',
            'KETERANGAN' => 'required'
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $data = Barang::findOrFail($id);

        if($data) {

            //update post
            $data->update([
                'NAMA_BARANG' => $request->NAMA_BARANG,
                'KATEGORI'    => $request->KATEGORI,
                'HARGA'       => $request->HARGA,
                'KETERANGAN'=> $request->KETERANGAN
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Updated',
                'data'    => $data  
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Data Not Found',
        ], 404);

    }

    public function destroy($id)
    {
        //find barang by ID
        $data = Barang::findOrfail($id);

        if($data) {

            //delete barang
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Data Not Found',
        ], 404);
    }
}
