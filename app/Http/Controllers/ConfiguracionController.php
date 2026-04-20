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
        // 🔥 LOGO
        if ($request->hasFile('logo')) {

            $archivo = $request->file('logo');
            $nombre = uniqid() . '.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('img'), $nombre);

            Configuracion::updateOrCreate(
                ['clave' => 'logo'],
                ['valor' => 'img/' . $nombre]
            );
        }

        // 🔥 HERO (ESTE ES EL IMPORTANTE)
        if ($request->hasFile('hero')) {

            $archivo = $request->file('hero'); // 🔥 CORRECTO

            $nombre = uniqid() . '.' . $archivo->getClientOriginalExtension();

            $archivo->move(public_path('img'), $nombre);

            Configuracion::updateOrCreate(
                ['clave' => 'hero'],
                ['valor' => 'img/' . $nombre] // 🔥 SOLO ESTO
            );
        }

        // 🔥 DEMÁS CAMPOS
        foreach ($request->except('_token', 'logo', 'hero') as $clave => $valor) {

            Configuracion::updateOrCreate(
                ['clave' => $clave],
                ['valor' => $valor]
            );
        }

        return back()->with('success', 'Configuración guardada');
    }
}