<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(["subcategories",'products'])->limit(10)->orderBy('id','DESC')->get();
        return responseData($categories, 'Categories List');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        try{
            // if($request->hasFile('image')){
            //     $image = $request->file('image');
            //     $name = time().'.'.$image->getClientOriginalExtension();
            //     $destinationPath = public_path('/images');
            //     $image->move($destinationPath, $name);
            //     $request->image = $name;
            // }
            if($request->hasFile('image')){
                $image_path=$request->file('image')->store("images",'public');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'image' => $image_path,
                'status' => $request->status,
            ];
    
            $category = Category::create($data);
            return responseData($category, 'Category Created', 201);
        }catch(err){
            return responseData(err,"category cant store",401);
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
        $category = Category::where('slug',$slug)->with(['subcategories','products'])->first();
        if($category){
            return responseData($category, 'Category Details');
        }else{
            return responseData(null, 'Category Not Found', 404);
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
        $category = Category::find($id);
        if($category){
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
                'image' => $request->image,
                'status' => $request->status,
            ];
            Category::where('id',$category)->update($data);
            return responseData($data, 'Category Updated', 201);
        }else{
            return responseData(null, 'Category Not Found', 404);
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
        if(Category::find($id)){
            Category::where('id',$id)->delete();
            return responseData(null,'Category deleted successfully',200);
        }else{
            return responseData(null,'Category not found',404);
        }


    }
}
