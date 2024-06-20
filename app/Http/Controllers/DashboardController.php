<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Inertia\Inertia;
use App\Models\Category; 
use App\Models\ClassCategory; 

class DashboardController extends Controller
{
    public function index()
    {
        $latestProducts = Product::with(['subcategory.category', 'images'])->latest()->take(15)->get();
        $categories = ClassCategory::all(); 
        $cart = session()->get('cart', []);
        $all_products = Product::all();
        $isFirstVisit = session()->get('isFirstVisit', true);
        session()->put('isFirstVisit', false);

        if (is_object($cart)) {
            $cart = (array) $cart;
        }

        return Inertia::render('Dashboard', [
            'latestProducts' => $latestProducts,
            'allProducts' => $all_products,
            'categories' => $categories,
            'cart' => array_values($cart),
            'isFirstVisit' => $isFirstVisit
        ]);
    }
}