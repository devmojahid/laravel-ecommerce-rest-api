<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy("id",'desc')->get();
        return responseData($tags,"All Tags",200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title, '-'),
        ];

        $tag = Tag::create($data);
        return responseData($tag, 'Tag Created', 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Tag::find($id)){
            $tag = Tag::find($id);
            return responseData($tag,"Tag",200);
        }
        return responseData(null,"Tag not found",401);
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
        if(Tag::find($id)){
            $tag = Tag::find($id);
            $tag->title = $request->title;
            $tag->description = $request->description;
            $tag->slug = Str::slug($request->title, '-');
            $tag->save();
            return responseData($tag,"Tag Updated",200);
        }
        return responseData(null,"Tag not found",401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Tag::find($id)){
            Tag::find($id)->delete();
            return responseData(null,"Tag Deleted",200);
        }
        return responseData(null,"Tag can't delete",401);

    }
}
