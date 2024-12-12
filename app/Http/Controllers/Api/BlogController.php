<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResources;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title'=> 'required|max:255',
            'slug'=> 'required',
            'user_id'=> 'required',
            'tag_id'=> 'required',
            'categori_id'=> 'required',
            'date'=> 'required|date',
            'image'=> 'required|image',
            'description' => 'required|max:255',
            

        ]);
        
        $input = $request->all();
    
        $blog = Blog::create($input);
        
        return new BlogResources($blog);
    }


    
    
    public function index(Request $request){
           $search = $request['search'] ?? "";
        if ($search != "") {
            $blogs = Blog::where('title', 'like', "%$search%")
                        ->orwhere('user_id', 'like', "%$search%")
                        ->orwhere('tag_id', 'like', "%$search%")
                        ->orwhere('categori_id', 'like', "%$search%")
                        ->orwhere('date', 'like', "%$search%")
                        ->get();
        } else {
            $blogs = Blog::all();
        }
        return BlogResources::collection($blogs);
    }



    
    public function edit(Request $request,$id)
    {
        $blog = Blog::find($id);
        return new BlogResources($blog);
    }



    
    public function update(Request $request,$id){
        $blog = Blog::find($id);
        $input = $request->all();
        if($blog->update($input)){
            return new BlogResources($blog);
            
        }
    }

    
    
    public function status(Request $request,$id){
        $request->validate([
            'status'=> Rule::in([0,1,2]),
        ]);
        $blog = Blog::find($id);
        $input = $request->all();
            $blog->update($input);
        return new BlogResources($blog);
        
    }




    public function delete($id){
        $blog = Blog::find($id);
        $blog->delete();
        return "Blog deleted successfully!";
    }
}