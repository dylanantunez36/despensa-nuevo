<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function enviar(Request $request)
    {
        $data = $request->all();

        $pedido = Pedido::create([
            'nombre' => $data['nombre'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'detalle' => $data['detalle'],
            'total' => $data['total']
        ]);

        $data['pedido_id'] = $pedido->id;

        // 📧 CORREO ADMIN 
        Mail::raw(
            "Nuevo pedido\n\nCliente: {$data['nombre']}\nTel: {$data['telefono']}\nDirección: {$data['direccion']}\n\nProductos:\n{$data['detalle']}\n\nTotal: L. {$data['total']}",
            function ($message) {
                $message->to('danyelantunez36@gmail.com')
                        ->subject('Nuevo Pedido');
            }
        );

        // 📧 CORREO CLIENTE
        Mail::send('emails.factura', $data, function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Factura de compra - Despensa Espinoza');
        });

        return response()->json(['success' => true]);
    }
}