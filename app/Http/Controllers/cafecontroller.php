<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cafe;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class cafecontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_cafe=Cafe::get();
            return response()->json($dt_cafe);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_cafe'=>'required',
            'alamat'=>'required',
            'harga'=>'required',
            'gambar'=>'required',
            'sedia'=>'required',
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Cafe::create([
            'nama_cafe'=>$req->nama_cafe,
            'alamat'=>$req->alamat,
            'harga'=>$req->harga,
            'gambar'=>$req->gambar,
            'sedia'=>$req->sedia,
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_cafe ()
    {
        $data_cafe=Cafe::count();
        $data_cafe1=Cafe::all();
        return Response()->json(['count'=> $data_cafe, 
        'cafe'=> $data_cafe1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_cafe'=>'required',
            'alamat'=>'required',
            'harga'=>'required',
            'gambar'=>'required',
            'sedia'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Cafe::where('id',$id)->update([
            'nama_cafe'=>$req->nama_cafe,
            'alamat'=>$req->alamat,
            'harga'  =>$req->harga,
            'gambar'=>$req->gambar,
            'sedia'=>$req->sedia,
            ]);
        if($ubah){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    public function destroy($id)
    {
        $hapus=Cafe::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
