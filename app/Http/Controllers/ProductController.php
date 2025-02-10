<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{   
    public function index(){

        $products = Product::with(['images' => function ($query) {
            $query->orderBy('id', 'asc')->limit(1);
        }])->paginate(5);
        

        return response()->json([
            'products' => $products
        ],200);

    }

    public function create_product(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'date' => 'nullable|date_format:Y-m-d H:i:s', 
        ]);
        if ($request->has('date')) {
            $validated['date'] = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category'=>$validated['category'],
            'date' =>$validated['date'],
        ]);

        $uploadedImages = [];

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $folder = $product->name;
                $filename = $product->name ."_".time().".".$image->extension();
                $path = $image->storeAs('uploads/'.$folder,$filename,'public');

                $productImage = ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);

                $uploadedImages[] = $path;
            }
        }
        return response()->json([
            'message' => 'Product uploaded successfully',
            'product' => $product,
            'images' => $uploadedImages
        ]);
    }
}
