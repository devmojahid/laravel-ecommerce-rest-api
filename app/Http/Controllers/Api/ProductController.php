<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Category,
    SubCategory,
    Brand,
    Tag,
    Product
};
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','subcategory','brand','tag','user'])->orderBy('id','desc')->get();
        return responseData($products,'All Products',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $image_path = null;
            if($request->hasFile('image')){
                $image_path = $request->file('image')->store('images/products','public');
            }
            
            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title,'-'),
                'summary' => $request->summary,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $image_path,
                'stock' => $request->stock,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'discount' => $request->discount,
                'weight' => $request->weight,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'user_id' => $request->user_id,
            ]);
            return responseData($product,'Product Created',200);
        }catch(\Exception $e){
            return responseData($e->getMessage(),'Something went wrong',500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with(['category','subcategory','brand','tag','user'])->where('slug',$slug)->first();
        return responseData($product,'Product Details',200);
        if(!$product){
            return responseData(null,'Product not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Product::find($id)){
            try{
                $image_path = null;
                if($request->hasFile('image')){
                    $image_path = $request->file('image')->store('images/products','public');
                }

                $product = Product::where('id',$id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'summary' => $request->summary,
                    'description' => $request->description,
                    'price' => $request->price,
                    'image' => $image_path,
                    'stock' => $request->stock,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'discount' => $request->discount,
                    'weight' => $request->weight,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand_id' => $request->brand_id,
                    'user_id' => $request->user_id,
                ]);
            return responseData($product,'Product Created',200);
            }catch(\Exception $e){
                return responseData($e->getMessage(),'Something went wrong',500);
            }
        }else{
            return responseData(null,'Product Not Found',404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Product::find($id)){
            Product::where('id',$id)->delete();
            return responseData(null,'Product Deleted',200);
        }
        return responseData(null,'Product Not Found',404);
    }
}
