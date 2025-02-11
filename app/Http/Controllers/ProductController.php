<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{   
    public function index(Request $request){
        $products = Product::query();

        if($request->searchQuery !=''){
            $products = Product::where('name', 'like', '%'. $request->searchQuery. '%');
        }
        if ($request->category != '') {
            $products->where('category', $request->category);
        }

        $products = $products->with(['images' => function ($query) {
            $query->orderBy('id', 'asc')->limit(1);
        }]);

        $products = $products->latest()->paginate(6);
        
        return response()->json([
            'products' => $products
        ],200);

    }

    public function edit($id){
        $product = Product::with('images')->find($id);

        return response()->json([
            'product'=> $product
        ],200);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'date' => 'nullable|date_format:Y-m-d H:i:s', 
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'date' => $validated['date'],
        ]);

        if($request->hasFile('images')){ 
                foreach($request->file('images') as $image){ 
                    $folder = "/uploads/".$request->name; 
                    $file = $request->name."_".time().".".$image->extension();
                    //Storage::move('public/'.$image->image_path, $new_path);
                    $path =$image->storeAs($folder,$file,'public');
                    
                    $productImage = ProductImage::create([
                        'product_id' => $product->id,
                        'name'=>$request->name.$image->extension(),
                        'image_path' => $path,
                    ]);
                }
        }

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product->load('images')
        ], 200);
    }

    public function create_product(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
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
                    'name'=>$filename,
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


    public function destroy($id){
        $product = Product::findOrfail($id);
        
        foreach($product->images as $image){
            $image_path = public_path()."/".$image->image_path;
            if(file_exists($image_path)){
                Storage::delete($image_path);
                $image->delete();
            }
        }

        $product->delete();
    }
}


