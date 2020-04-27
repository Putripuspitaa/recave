<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaksi;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class transaksicontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_transaksi=Transaksi::get();
            return response()->json($dt_transaksi);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'tgl_transaksi'=>'required',
            'check_in'=>'required',
            'check_out'=>'required',
            'nomor_meja'=>'required',
            
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Transaksi::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'check_in'=>$req->check_in,
            'check_out'=>$req->check_out,
            'nomor_meja'=>$req->nomor_meja,
            
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_transaksi ()
    {
        $data_transaksi=Transaksi::count();
        $data_transaksi1=Transaksi::all();
        return Response()->json(['count'=> $data_transaksi, 
        'transaksi'=> $data_transaksi1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'tgl_transaksi'=>'required',
            'check_in'=>'required',
            'check_out'=>'required',
            'nomor_meja'=>'required',
        
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Transaksi::where('id',$id)->update([
            'id_pelanggan'=>$req->id_pelanggan,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'check_in'  =>$req->check_in,
            'check_out'=>$req->check_out,
            'nomor_meja'=>$req->nomor_meja,
        
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
        $hapus=Transaksi::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
