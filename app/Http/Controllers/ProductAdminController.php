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

        $products = Product::with('images')->select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.quantity',
            'products.class_categories_id',
            'class_categories.name as class_category',
        )
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
            'quantity' => 'required',
            'class_category_id' => 'required|numeric',
        ]);
    
        // DB::beginTransaction();
    
        try {
            $uploadedImageDetails = [];
            foreach ($request->file('images') as $image) {
                $classCategoryId = $request->input('class_category_id'); 

                $classCategory = ClassCategory::find($classCategoryId);
                if (!$classCategory) {
                    continue;
                }
                $cloudinaryFolder = $classCategory->name;

                $cloudinaryResponse = Cloudinary::upload($image->getRealPath(), [
                    'folder' => $cloudinaryFolder 
                  ]);
                $uploadedFileUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

                $uploadedImageDetails[] = [
                    'image_path' => $uploadedFileUrl,
                    'image_public_id' => $publicId,
                ];
            }

            $product = new Product([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
                'class_categories_id' => $request->input('class_category_id')
            ]);
            $product->save();
            // dd($product);
    
            foreach ($uploadedImageDetails as $imageDetail) {
                $productImage = new ProductImage([
                    'product_id' => $product->id,
                    'image_path' => $imageDetail['image_path'],
                    'image_public_id' => $imageDetail['image_public_id']
                ]);
                $productImage->save();
            }
    
            // DB::commit();
    
            return redirect('admin/products')->with('success', 'Producto registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);

            return redirect()->back()->with('error', 'Error al registrar el producto: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|max:150',
            'price'=>'required',
            'class_category_id'=>'required|numeric',
        ]);
        try {
            $data = $request->only(['name', 'price', 'quantity', 'description', 'class_category_id']);

            $product->update($data);

        } catch (Exception $e) {
            dd($e);

        }

        return redirect('admin/products');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Cloudinary::destroy($image->image_public_id);
            $image->delete();
        }
    
        $product->delete();

        return redirect('admin/products');
    }

}
