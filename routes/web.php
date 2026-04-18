<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

/* =========================
   HOME
========================= */
Route::get('/', function () {
    return view('pages.home');
});

/* =========================
   LOGIN
========================= */
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function (Request $request) {

    // 🔥 obtener contraseña desde la BD
    $pass = \App\Models\Configuracion::where('clave','admin_password')->value('valor') ?? '1234';

    if ($request->usuario === 'admin' && $request->password === $pass) {

        session([
            'admin' => true,
            'login_time' => now()
        ]);

        return redirect('/admin');
    }

    return back()->with('error', 'Credenciales incorrectas');
});

/* =========================
   LOGOUT
========================= */
Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
});

/* =========================
   ADMIN (PROTEGIDO)
========================= */
Route::prefix('admin')->group(function () {

    $checkAdmin = function () {
        if (!session()->has('admin')) return redirect('/login');
    };

    /* 🔥 DASHBOARD */
    Route::get('/', function () use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $productos = \App\Models\Producto::all();

        $pendientes = \App\Models\Pedido::where('estado', 'pendiente')->count();
        $procesados = \App\Models\Pedido::where('estado', 'procesado')->count();
        $totalPedidos = \App\Models\Pedido::count();
        $totalProductos = \App\Models\Producto::count();

        return view('admin.index', compact(
            'productos',
            'pendientes',
            'procesados',
            'totalPedidos',
            'totalProductos'
        ));
    });

    Route::get('/create', function () use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->create();
    });

    Route::post('/store', function (Request $request) use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->store($request);
    });

    Route::get('/edit/{id}', function ($id) use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->edit($id);
    });

    Route::post('/update/{id}', function (Request $request, $id) use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->update($request, $id);
    });

    Route::get('/delete/{id}', function ($id) use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->destroy($id);
    });

    

    /* 🔥 DESTACADO */
    Route::post('/destacado/{id}', function ($id) use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $producto = \App\Models\Producto::find($id);

        if ($producto) {
            $producto->destacado = !$producto->destacado;
            $producto->save();
        }

        return back();
    });

    /* 🔥 OFERTA */
    Route::post('/oferta/{id}', function ($id) use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $producto = \App\Models\Producto::find($id);

        if ($producto) {
            $producto->oferta = !$producto->oferta;
            $producto->save();
        }

        return back();
    });

    /* 🔥 PEDIDOS */
    Route::get('/pedidos', function () use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $pedidos = \App\Models\Pedido::latest()->get();

        return view('admin.pedidos', compact('pedidos'));
    });

    /* 🔥 CAMBIAR ESTADO */
    Route::post('/pedido/{id}/estado', function ($id) use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $pedido = \App\Models\Pedido::find($id);

        if ($pedido) {
            $pedido->estado = 'procesado';
            $pedido->save();

            Mail::send('emails.pedido_listo', [
                'nombre' => $pedido->nombre,
                'tipo_entrega' => $pedido->tipo_entrega
            ], function ($message) use ($pedido) {
                $message->to($pedido->email)
                        ->subject('Pedido listo - Despensa Espinoza');
            });
        }

        return back();
    });

});

/* =========================
   CATEGORÍAS
========================= */
Route::get('/categoria/{categoria}', [ProductoController::class, 'categoria']);

/* =========================
   CHECKOUT
========================= */
Route::get('/checkout', function () {
    return view('pages.checkout');
});

/* =========================
   ENVIAR PEDIDO
========================= */
Route::post('/enviar-pedido', [PedidoController::class, 'enviar']);

/* =========================
   OFERTAS
========================= */
Route::get('/ofertas', function () {
    $productos = \App\Models\Producto::where('oferta', true)->get();
    return view('pages.ofertas', compact('productos'));
});

/* =========================
   CHECK PEDIDOS (NOTIFICACIÓN)
========================= */
Route::get('/admin/check-pedidos', function () {

    if (!session()->has('admin')) return response()->json([]);

    return \App\Models\Pedido::latest()->take(1)->get();

});

/* =========================
   PRODUCTOS ADMIN
========================= */
Route::get('/admin/productos', function () {

    if (!session()->has('admin')) return redirect('/login');

    $productos = \App\Models\Producto::all();

    return view('admin.productos', compact('productos'));
});

use App\Http\Controllers\ConfiguracionController;

Route::get('/admin/configuracion', [ConfiguracionController::class, 'index']);
Route::post('/admin/configuracion', [ConfiguracionController::class, 'guardar']);