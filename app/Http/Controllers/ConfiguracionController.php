<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{
    // 🔥 Mostrar formulario
    public function index()
    {
        $config = Configuracion::pluck('valor', 'clave');
        return view('admin.configuracion', compact('config'));
    }

    // 🔥 Guardar cambios
    public function guardar(Request $request)
{
    // 🔥 LOGO (archivo)
    if ($request->hasFile('logo')) {

        $archivo = $request->file('logo');
        $nombre = time() . '.' . $archivo->getClientOriginalExtension();

        $archivo->move(public_path('img'), $nombre);

        Configuracion::updateOrCreate(
            ['clave' => 'logo'],
            ['valor' => 'img/' . $nombre]
        );
    }

    // 🔥 DEMÁS CAMPOS
    foreach ($request->except('_token', 'logo') as $clave => $valor) {

        Configuracion::updateOrCreate(
            ['clave' => $clave],
            ['valor' => $valor]
        );
    }

    return back()->with('success', 'Configuración guardada');
}
}