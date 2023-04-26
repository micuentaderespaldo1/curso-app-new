<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class CrudController extends Controller
{
    public function index(){
        $datos = DB::table("productos")->get();
        /*$datos = [
            "id_producto"=>"1",
            "nombre_producto"=>"Disco",
            "categoria"=>"Auto",
            "p_venta"=>"3.00"
        ];*/
        return View("welcome")->with("datos",$datos);

    }
    public function create(Request $request){
        try{
            $sql=DB::insert("insert into productos (id_producto, nombre_producto, categoria, p_venta) values (?,?,?,?)",[
                $request->txtid,
                $request->txtnombre,
                $request->txtcategoria,
                $request->txtprecio
                ]);
        }catch(\Throwable $th){
            $sql=0;
        }
        if($sql==true){
            return back()->with("correcto","Producto registrado!");
        }else{
            return back()->with("incorrecto","Producto no fue registrado!");
        }        
    }
    public function update(Request $request){
        try{
            $sql=DB::update("update productos set nombre_producto=?, categoria=?, p_venta=? where id_producto=?",[
                $request->$txtnombre2,
                $request->$txtcategoria2,
                $request->$txtprecio2,
                $request->$txtid2
            ]);
        }catch(\Throwable $th){
            $sql=0;
        }
        if($sql==true){
            return back()->with("correcto", "Los cambios fueron guradados para el producto ".$request->txtid2);
        }else{
            return back()->with("incorrecto", "¡No se guardaron los cambios para el producto ".$request->txtid2."!");
        }
    }
}
