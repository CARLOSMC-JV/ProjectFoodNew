<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Rating;

class ProductController extends Controller
{
    public function index(Request $request, $categoria, $subcategoriaSlug)
    {
        $categoria = Category::where('name', $categoria)->first();

        if (!$categoria) {
            abort(404);
        }

        $subcategoria = Subcategory::where('name', $subcategoriaSlug)->first();

        if (!$subcategoria) {
            abort(404);
        }
        $subcategorias_list = Subcategory::where('category_id', $categoria->id)->get();
        

        $subcategoriaIds = $subcategorias_list->pluck('id');

        $products = Product::whereIn('subcategory_id', $subcategoriaIds)
        ->orWhereNull('subcategory_id')
        ->with('images') 
        ->get();

        
        return inertia('showProductsByCategory/Index', [
            'products' => $products,
            'subcategory' => $subcategoria->name,
            'subcategory_id' => $subcategoria->id,
            'category' => $categoria->name,
            'category_list'=>$subcategorias_list
        ]);
    }
    public function listByClassCategory(Request $request, $categoria)
    {
        $classCategory = ClassCategory::find($categoria);
        if (!$classCategory) {
            abort(404);
        }

        $products = Product::where('class_categories_id', $categoria)
            ->with('images') 
            ->get();
        $all_products = Product::all();

        $cart = session()->get('cart', []);
        return inertia('ProductCategory/Index', [
            'products' => $products,
            'all_products' => $all_products,
            'cart' => $cart,
            'class_category' => $classCategory->name
        ]);
    }
    public function listByCategory(Request $request, $categoria)
    {
        $category = Category::where('id', $categoria)->first();
        if (!$category) {
            abort(404);
        }

        $classCategory = $category->classCategory;
        if (!$classCategory) {
            abort(404);
        }

        $subcategorias = Subcategory::where('category_id', $category->id)->get();

        $subcategoriaIds = $subcategorias->pluck('id');

       
        $products = Product::where(function ($query) use ($subcategoriaIds, $category) {
            $query->whereIn('subcategory_id', $subcategoriaIds)
                  ->orWhereNull('subcategory_id');
        })
        ->where('category_id', $category->id)
        ->with('images') 
        ->get();

        return inertia('ProductCategory/Index', [
            'products' => $products,
            'category' => $category->name,
            'class_category' => $classCategory->name,
            'category_list'=>$subcategorias
        ]);
    }

    public function showDetail($category_param, $id)
    {
        $product = Product::with(['subcategory', 'images'])->findOrFail($id);

        $subcategory = $product->subcategory;

        $category = $subcategory->category()->first();

        $product->category = $category->name;

        $product->subcategory = $subcategory->name;
        $cart = session()->get('cart', []);
        \Log::info('Carrito en showDetail:', $cart);

        return inertia('ProductDetail/Index', [
            'product' => $product,
            'cart' => $cart
        ]);

    }

    public function showDetail2($category_param, $id)
    {
        $product = Product::with(['subcategory','images'])->findOrFail($id);
        
            $product->category = 'Sin categoría';
        


        return inertia('ProductDetail/Index', [
            'product' => $product
        ]);

    }

    public function showDetailProduct($category_param, $id)
    {
        $category = ClassCategory::where('id', $category_param)->first();

        if (!$category) {
            abort(404, 'Categoría no encontrada');
        }

        $product = Product::with(['classCategory', 'images'])
            ->where('class_categories_id', $category->id)
            ->findOrFail($id);


        if (empty($product->category)) {
            $product->category = 'Sin categoría';
        }

        return inertia('ProductDetail/Index', [
            'product' => $product
        ]);

    }

    public function showProductsByCategory(Request $request, $categoria)
    {
        $category = Category::where('name', $categoria)->first();

        if (!$category) {

            abort(404);
        }
        
        $subcategorias = Subcategory::where('category_id', $category->id)->get();

        $subcategoriaIds = $subcategorias->pluck('id');

        $products = Product::whereIn('subcategory_id', $subcategoriaIds)
        ->orWhere(function ($query) use ($subcategoriaIds) {
            if ($subcategoriaIds->isEmpty()) {
                $query->whereNull('subcategory_id');
            }
        })
        ->with('images')->get();


        return inertia('showProductsByCategory/Index', [
            'products' => $products,
            'subcategory' => "Todas las subcategorías",
            'subcategory_id' => 0,
            'category' => $category->name,
            'category_list'=>$subcategorias
        ]);
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);

    }

    public function rate(Request $request, Product $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $product = Product::find($productId->id);
        // dd($productId->id);


        $existingRating = $product;
        if ($existingRating) {

            $existingRating->update([
                'rating' => $request->rating,
            ]);
            $existingRating->save();

        } else {

            $product->ratings()->create([
                'rating' => $request->rating,
            ]);
        }
        

        $product->save();

        return redirect()->back();
    }

}
