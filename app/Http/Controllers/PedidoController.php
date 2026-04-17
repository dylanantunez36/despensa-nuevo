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

        // 🔥 DEFINIR DIRECCIÓN SEGÚN TIPO
        $direccionFinal = $data['tipo_entrega'] === 'domicilio'
            ? $data['direccion']
            : null;

        // 🔥 TEXTO PARA CORREO
        $direccionTexto = $data['tipo_entrega'] === 'domicilio'
            ? $data['direccion']
            : 'Recoger en tienda';

        // 🔥 GUARDAR PEDIDO
        $pedido = Pedido::create([
            'nombre' => $data['nombre'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'tipo_entrega' => $data['tipo_entrega'],
            'direccion' => $direccionFinal,
            'observacion' => $data['observacion'] ?? null,
            'detalle' => $data['detalle'],
            'total' => $data['total']
        ]);

        // 🔥 AGREGAR ID
        $data['pedido_id'] = $pedido->id;

        // 📧 CORREO ADMIN 
        Mail::raw(
            "Nuevo pedido\n\nCliente: {$data['nombre']}\nTel: {$data['telefono']}\nTipo: {$data['tipo_entrega']}\nDirección: {$direccionTexto}\n\nObservación: " . ($data['observacion'] ?? '---') . "\n\nProductos:\n{$data['detalle']}\n\nTotal: L. {$data['total']}",
            function ($message) {
                $message->to('danyelantunez36@gmail.com')
                        ->subject('Nuevo Pedido');
            }
        );

        // 📧 CORREO CLIENTE
        Mail::send('emails.factura', $data, function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Comprobante de pedido - Despensa Espinoza');
        });

        session()->flash('nuevo_pedido', true);

        return response()->json([
            'success' => true
        ]);
    }
}