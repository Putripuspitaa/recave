<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pelanggan;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class pelanggancontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_pelanggan=Pelanggan::get();
            return response()->json($dt_pelanggan);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'nomor_ktp'=>'required',
        
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Pelanggan::create([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'nomor_ktp'=>$req->nomor_ktp,
            
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_pelanggan ()
    {
        $data_pelanggan=Pelanggan::count();
        $data_pelanggan1=Pelanggan::all();
        return Response()->json(['count'=> $data_pelanggan, 
        'pelanggan'=> $data_pelanggan1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'nomor_ktp'=>'required',
            
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Pelanggan::where('id',$id)->update([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'  =>$req->telp,
            'nomor_ktp'=>$req->nomor_ktp,
            
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
        $hapus=Pelanggan::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
