<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->limit(5)->get();
        return responseData($brands,"All Brands",200);
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
            $image_path="";
            if($request->hasFile('image')){
                $image_path=$request->file('image')->store("images/brands",'public');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'image' => $image_path,
                'status' => $request->status,
            ];
    
            $brands = Brand::create($data);
            return responseData($brands, 'brands Created', 201);
        }catch(err){
            return responseData(err,"brands can't store",401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brands = Brand::find($id);
        if($brands){
            return responseData($brands,"Brand Details",200);
        }else{
            return responseData($brands,"Brand Not Found",404);
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
        $brand = Brand::find($id);
        if($brand){
            $image_path="";
            if($request->hasFile('image')){
                $image_path=$request->file('image')->store("images/brands",'public');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'image' => $image_path,
                'status' => $request->status,
            ];
            $brand->update($data);
            return responseData($brand,"Brand Updated",200);
        }else{
            return responseData($brand,"Brand Not Found",404);
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
        if(Brand::find($id)){
            Brand::where('id',$id)->delete();
            return responseData($id,"Brand Deleted",200);
        }else{
            return responseData($id,"Brand Not Found",404);
        }
    }
}
