<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = [

            // ABARROTES
            ["nombre"=>"Café Oro","precio"=>75,"imagen"=>"cafeoro.jpg","categoria"=>"abarrotes"],
            ["nombre"=>"Frijoles","precio"=>25,"imagen"=>"frijoles.webp","categoria"=>"abarrotes"],
            ["nombre"=>"Harina","precio"=>40,"imagen"=>"harina.webp","categoria"=>"abarrotes"],
            ["nombre"=>"Zucaritas","precio"=>35,"imagen"=>"zucaritas.jpg","categoria"=>"abarrotes"],

            // HIGIENE
            ["nombre"=>"Colgate","precio"=>45,"imagen"=>"colgate.jpg","categoria"=>"higiene"],
            ["nombre"=>"Desodorante","precio"=>60,"imagen"=>"desodorante.jpg","categoria"=>"higiene"],
            ["nombre"=>"Rasuradora","precio"=>150,"imagen"=>"rasuradora.png","categoria"=>"higiene"],
            ["nombre"=>"Cepillos","precio"=>35,"imagen"=>"cepillos.jpg","categoria"=>"higiene"],

            // BEBÉS
            ["nombre"=>"Pampers","precio"=>150,"imagen"=>"pampers.webp","categoria"=>"bebes"],
            ["nombre"=>"Nido","precio"=>120,"imagen"=>"nido.webp","categoria"=>"bebes"],

            // LÁCTEOS
            ["nombre"=>"Leche Entera","precio"=>30,"imagen"=>"Leche Entera.webp","categoria"=>"lacteos"],
            ["nombre"=>"Queso","precio"=>60,"imagen"=>"Queso semiduro.jpg","categoria"=>"lacteos"],

            // CARNES
            ["nombre"=>"Chuleta de cerdo","precio"=>115,"imagen"=>"Chuleta de cerdo.jpg","categoria"=>"carnes"],
            ["nombre"=>"Pollo","precio"=>90,"imagen"=>"pollo.webp","categoria"=>"carnes"],

            // LIMPIEZA
            ["nombre"=>"Cloro","precio"=>50,"imagen"=>"Cloro Magia Blanca.webp","categoria"=>"limpieza"],
            ["nombre"=>"Fabuloso","precio"=>55,"imagen"=>"Fabuloso.webp","categoria"=>"limpieza"],

            // BEBIDAS
            ["nombre"=>"Agua Azul","precio"=>20,"imagen"=>"aguazul.jpg","categoria"=>"bebidas"],
            ["nombre"=>"Arizona","precio"=>35,"imagen"=>"arizona.jpg","categoria"=>"bebidas"],
            ["nombre"=>"Salva Vida","precio"=>30,"imagen"=>"SalvaVida.jpg","categoria"=>"bebidas"],

            // PANADERÍA
            ["nombre"=>"Pan Bimbo","precio"=>50,"imagen"=>"panbimbo.jpg","categoria"=>"panaderia"],
            ["nombre"=>"Pan Integral","precio"=>45,"imagen"=>"panintegral.webp","categoria"=>"panaderia"],

            // FARMACIA
            ["nombre"=>"Acetaminofen","precio"=>20,"imagen"=>"Acetaminofen.jpg","categoria"=>"farmacia"],
            ["nombre"=>"Panadol","precio"=>25,"imagen"=>"Panadol Extra Fuerte.png","categoria"=>"farmacia"],

            // EMBUTIDOS
            ["nombre"=>"Salchicha","precio"=>50,"imagen"=>"Salchicha de pollo.webp","categoria"=>"embutidos"],
            ["nombre"=>"Jamon","precio"=>60,"imagen"=>"Jamon de pollo.webp","categoria"=>"embutidos"],

            // CONGELADOS
            ["nombre"=>"Nuggets","precio"=>80,"imagen"=>"Niggets de pollo.webp","categoria"=>"congelados"],
            ["nombre"=>"Helado","precio"=>60,"imagen"=>"Helados pino.webp","categoria"=>"congelados"],

            // VINOS
            ["nombre"=>"Vino Tinto","precio"=>150,"imagen"=>"Vino Tinto.webp","categoria"=>"vinos"],
            ["nombre"=>"Smirnoff","precio"=>180,"imagen"=>"smirnoff.webp","categoria"=>"vinos"],

        ];

        foreach ($productos as $p) {
            Producto::create($p);
        }
    }
}