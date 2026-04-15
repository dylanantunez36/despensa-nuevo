<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

    if ($request->usuario === 'admin' && $request->password === '1234') {

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

    // 🔥 función reutilizable (evita repetir código)
    $checkAdmin = function () {
        if (!session()->has('admin')) return redirect('/login');
    };

    Route::get('/', function () use ($checkAdmin) {
        if ($res = $checkAdmin()) return $res;
        return app(ProductoController::class)->index();
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

    /* =========================
       TOGGLE OFERTA
    ========================= */
    Route::post('/oferta/{id}', function ($id) use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $producto = \App\Models\Producto::find($id);

        if ($producto) {
            $producto->oferta = !$producto->oferta;
            $producto->save();
        }

        return back();
    });

    /* =========================
       PEDIDOS
    ========================= */
    Route::get('/pedidos', function () use ($checkAdmin) {

        if ($res = $checkAdmin()) return $res;

        $pedidos = \App\Models\Pedido::latest()->get();

        return view('admin.pedidos', compact('pedidos'));
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