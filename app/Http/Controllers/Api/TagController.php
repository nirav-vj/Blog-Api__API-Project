<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResources;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',           
    ]);
    
    if($tag = Tag::create($validatedData)){
        
        return new TagResources($tag);
        
    }
}




    public function index(Request $request)
    {
           $search = $request['search'] ?? "";
        if ($search != "") {
            $tag = Tag::where('name', 'like', "%$search%")->get();
        } else {
            $tag = Tag::all();
        }
        return TagResources::collection($tag);
        }



    
    public function edit($id)
    {
        $tag = Tag::find($id);
         if($tag == null){
            return 'user not found';
         }
        return new TagResources($tag);
    }



    
     public function update(Request $request,$id)
    {

        $tag = Tag::find($id);
        $input = $request->all();
        
        if($tag->update($input)){
                return response()->json([
                'message' => 'Your data is updated successfully',
                'tag' => new TagResources($tag)
            ]);
        }
    } 
    
    

    
    public function delete(Request $request,$id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return "Tag deleted successfully";
        
    }

}