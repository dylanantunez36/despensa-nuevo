<?php
function getConfig($clave){
    return \App\Models\Configuracion::where('clave', $clave)->value('valor');
}