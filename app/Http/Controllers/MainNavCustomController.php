<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class MainNavCustomController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        // Puedes devolver los datos del carrito en formato JSON
        return response()->json(['cart' => $cart]);
    }
}