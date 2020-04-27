<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Detail_transaksi;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class detailcontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_detail=Detail_transaksi::get();
            return response()->json($dt_detail);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_cafe'=>'required',
            'subtotal'=>'required',
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Detail_transaksi::create([
            'id_transaksi'=>$req->id_transaksi,
            'id_cafe'=>$req->id_cafe,
            'subtotal'=>$req->subtotal,
            
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_detail ()
    {
        $data_detail=Detail_transaksi::count();
        $data_detail1=Detail_transaksi::all();
        return Response()->json(['count'=> $data_detail, 
        'transaksi'=> $data_detail1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_cafe'=>'required',
            'subtotal'=>'required',
            
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Detail_transaksi::where('id',$id)->update([
            'id_transaksi'=>$req->id_transaksi,
            'id_cafe'=>$req->id_cafe,
            'subtotal'  =>$req->subtotal,
           
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
        $hapus=Detail_transaksi::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
