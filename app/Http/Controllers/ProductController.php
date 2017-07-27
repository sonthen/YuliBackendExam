<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\UnitRumah;


class ProductController extends Controller
{

    
    function CreateNewUnit(Request $request){
         DB::beginTransaction();
        try{
          $this->validate($request,['kavling'=>'required']);
          $this->validate($request,['blok'=>'required']);
          $this->validate($request,['no_rumah'=>'required']);
          $this->validate($request,['harga_rumah'=>'required']);
          $this->validate($request,['luas_tanah'=>'required']);
          $this->validate($request,['luas_bangunan'=>'required']);
          
          $newdata = new    UnitRumah;
          $newdata->kavling = $request->input('kavling');
          $newdata->blok = $request->input('blok');
          $newdata->no_rumah = $request->input('no_rumah');
          $newdata->harga_rumah=$request->input('harga_rumah');
          $newdata->luas_tanah=$request->input('luas_tanah');
          $newdata->luas_bangunan=$request->input('luas_bangunan');
          $newdata->save();
          DB::commit();
            return response()->json(["message"=>"success"],200);
        }
    catch(\Exception $e){
            DB::rollback();
            return response()->json(["message"=>$e->getMessage()],500);
        }
     }

    function DeleteUnit(Request $request){
        DB::beginTransaction();
       try{
        $id=$request->input('id');
        DB::delete('delete from unit where id=?',[$id]);
        DB::commit();
       }
       catch(\Exception $e){
            DB::rollback();
            return response()->json(["message"=>$e->getMessage()],500);
        }
     }
}
