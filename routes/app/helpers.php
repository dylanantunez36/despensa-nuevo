<?php

use App\Models\Configuracion;

if (!function_exists('getConfig')) {

    function getConfig($clave){
        return Configuracion::where('clave', $clave)->value('valor');
    }

}