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

        // 🔥 ASEGURAR TIPO ENTREGA
        $tipoEntrega = $data['tipo_entrega'] ?? 'tienda';

        // 🔥 DEFINIR DIRECCIÓN SEGÚN TIPO
        $direccionFinal = $tipoEntrega === 'domicilio'
        ? ($data['direccion'] ?? '')
        : 'Recoger en tienda';

        // 🔥 TEXTO PARA CORREO
        $direccionTexto = $tipoEntrega === 'domicilio'
            ? ($data['direccion'] ?? '')
            : 'Recoger en tienda';

        // 🔥 GUARDAR PEDIDO
        $pedido = Pedido::create([
            'nombre' => $data['nombre'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'tipo_entrega' => $tipoEntrega,
            'direccion' => $direccionFinal,
            'observacion' => $data['observacion'] ?? null,
            'detalle' => $data['detalle'],
            'total' => $data['total']
        ]);

        // 🔥 DATOS SEGUROS PARA CORREO
        $data = [
            'pedido_id' => $pedido->id,
            'nombre' => $pedido->nombre,
            'telefono' => $pedido->telefono,
            'email' => $pedido->email,
            'tipo_entrega' => $tipoEntrega,
            'direccion' => $direccionFinal ?? '',
            'direccionTexto' => $direccionTexto,
            'observacion' => $pedido->observacion ?? '---',
            'detalle' => $pedido->detalle,
            'total' => $pedido->total
        ];

        // 📧 CORREO ADMIN 
        Mail::raw(
            "Nuevo pedido\n\nCliente: {$data['nombre']}\nTel: {$data['telefono']}\nTipo: {$data['tipo_entrega']}\nDirección: {$data['direccionTexto']}\n\nObservación: {$data['observacion']}\n\nProductos:\n{$data['detalle']}\n\nTotal: L. {$data['total']}",
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