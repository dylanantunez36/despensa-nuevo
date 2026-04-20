<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{

    /* =========================
       PANEL ADMIN
    ========================= */

    public function index()
    {
        $productos = Producto::all();
        return view('admin.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $archivo = $request->file('imagen');
        $nombreImagen = time() . "." . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('img/Productos'), $nombreImagen);

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'categoria' => $request->categoria,
            'imagen' => $nombreImagen,

            // 🔥 OFERTA
            'oferta' => $request->oferta ? 1 : 0,
            'precio_oferta' => $request->oferta ? $request->precio_oferta : null
        ]);

        return redirect('/admin/productos')->with('success', 'Producto agregado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('admin.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        // 🔥 IMAGEN (SI CAMBIA)
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . "." . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('img/Productos'), $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        // 🔥 DATOS
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->categoria = $request->categoria;

        // 🔥 OFERTA (AQUÍ ESTABA EL ERROR)
        $producto->oferta = $request->oferta ? 1 : 0;
        $producto->precio_oferta = $request->oferta ? $request->precio_oferta : null;

        $producto->save();

        return redirect('/admin');
    }

    public function destroy($id)
    {
        Producto::find($id)->delete();
        return redirect('/admin');
    }

    /* =========================
       CATEGORÍAS (TIENDA)
    ========================= */
    public function categoria($categoria)
    {
        $productos = Producto::where('categoria', $categoria)->get();

        return view('pages.categoria', [
            'productos' => $productos,
            'nombre' => ucfirst($categoria)
        ]);
    }
}