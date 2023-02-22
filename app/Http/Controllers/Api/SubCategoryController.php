<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorys = Subcategory::with('category')->orderBy('id','DESC')->get();
        return responseData($subcategorys,'subcategorys fetched successfully',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:subcategories',
            'description' => 'string',
            'image' => 'string',
            'status' => 'string',
        ]);

        try{
            if($request->hasFile('image')){
                $image_path=$request->file('image')->store("images",'public');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'category_id' => $request->category_id,
                'image' => $image_path,
                'status' => $request->status,
            ];
    
            $category = Category::create($data);
            return responseData($category, 'SubCategory Created', 201);
        }catch(err){
            return responseData(err,"Subcategory cant store",401);
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
        $subcategorys = Subcategory::with('category')->where('id',$id)->first();
        return responseData($subcategorys,'subcategorys fetched successfully',200);
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
        $subcategorys = Subcategory::find($id);
        if($subcategorys){
            if($request->hasFile('image')){
                $image_path=$request->file('image')->store("images",'public');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'category_id' => $request->category_id,
                'image' => $image_path,
                'status' => $request->status,
            ];
    
            $category = Category::update($data);
            return responseData($category, 'SubCategory Updated', 201);
        }else{
            return responseData(null,'subcategory not found',404);
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
        if(Subcategory::find($id)){
            Subcategory::where('id',$id)->delete();
            return responseData(null,'subcategory deleted successfully',200);
        }else{
            return responseData(null,'subcategory not found',404);
        }
    }
}
