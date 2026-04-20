<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    }

    public function store(Request $request){

        $archivo = $request->file('imagen');
        $nombre = time().".".$archivo->getClientOriginalExtension();
        $archivo->move(public_path('img/categorias'), $nombre);

        Categoria::create([
            'nombre' => $request->nombre,
            'slug' => strtolower(str_replace(' ','-',$request->nombre)),
            'imagen' => $nombre,
            'activo' => 1
        ]);

        return back();
    }

    public function toggle($id){
        $cat = Categoria::find($id);
        $cat->activo = !$cat->activo;
        $cat->save();

        return back();
    }

    public function destroy($id){
        Categoria::find($id)->delete();
        return back();
    }
}