<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ProductAdminController extends Controller
{
    public function index(){
        // $products = Product::select('products.id','products.name', 'products.description', 'products.price', 'products.image', 'subcategories.category_id as category_id', 'categories.class_category_id as class_category_id', 'subcategory_id', 'class_categories.name as class_category', 'categories.name as category', 'subcategories.name as subcategory')
        // ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        // ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        // ->join('class_categories', 'class_categories.id', '=', 'categories.class_category_id')
        // ->get();

        $products = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.image',
            'products.subcategory_id',
            'products.class_categories_id',
            'subcategories.category_id as category_id',
            'categories.class_category_id as class_category_id',
            'class_categories.name as class_category',
            'categories.name as category',
            'subcategories.name as subcategory'
        )
        ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('class_categories', 'class_categories.id', '=', 'products.class_categories_id') // Usar class_categories_id de la tabla products

        ->orderBy('products.created_at', 'desc')  // Ordenar por fecha de creación en orden descendente
        ->get();

        $subcategories=Subcategory::all();
        $categories=Category::all();
        $class_categories=ClassCategory::all();

        return Inertia::render('Admin/Product/Index', ['products' => $products, 'subcategories'=>$subcategories, 'categories'=>$categories, 'class_categories'=>$class_categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'price' => 'required',
            // 'description' => 'required',
            // 'quantity' => 'required',
            'images.*' => 'required|image',
            'class_category_id' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);
    
        // Procesamiento de imágenes en lote
        $uploadedImageUrls = [];
        foreach ($request->file('images') as $image) {
            $uploadedFileUrl = cloudinary()->upload($image->getRealPath())->getSecurePath();
            $uploadedImageUrls[] = $uploadedFileUrl;
        }
    
        DB::beginTransaction();
    
        try {
            $product = new Product([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'class_categories_id' => $request->input('class_category_id'),
                'category_id' => $request->input('category_id'),
                'subcategory_id' => $request->input('subcategory_id'),
                'image' => implode(',', $uploadedImageUrls),
            ]);
            $product->save();
    
            foreach ($uploadedImageUrls as $uploadedFileUrl) {
                $productImage = new ProductImage([
                    'product_id' => $product->id,
                    'image_path' => $uploadedFileUrl,
                ]);
                $productImage->save();
            }
    
            DB::commit();
    
            return redirect('admin/products')->with('success', 'Producto registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar el producto: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|max:150',
            'price'=>'required',
            'subcategory_id'=>'required|numeric',
        ]);
        $data = $request->only(['name', 'price', 'quantity', 'description', 'subcategory_id']);
        $product->subcategory()->update([
            'category_id' => $request->input('category_id'),
            // Otros campos de subcategories que deseas actualizar
        ]);
        $product->update($data);

        $product->subcategory->category_id = $request->input('category_id');
        $product->subcategory->save();

        return redirect('admin/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('admin/products');
    }

}
