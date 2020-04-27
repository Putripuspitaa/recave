<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Menu;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class menucontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_menu=Menu::get();
            return response()->json($dt_menu);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'keterangan'=>'required',
            'harga'=>'required',
            'gambar'=>'required',
            
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Menu::create([
            'nama'=>$req->nama,
            'keterangan'=>$req->keterangan,
            'harga'=>$req->harga,
            'gambar'=>$req->gambar,
            
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    public function tampil_menu ()
    {
        $data_menu=Menu::count();
        $data_menu1=Menu::all();
        return Response()->json(['count'=> $data_menu, 
        'menu'=> $data_menu1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'keterangan'=>'required',
            'harga'=>'required',
            'gambar'=>'required',
            
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Menu::where('id',$id)->update([
            'nama'=>$req->nama,
            'keterangan'=>$req->keterangan,
            'harga'  =>$req->harga,
            'gambar'=>$req->gambar,
            
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
        $hapus=Menu::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 
            'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
