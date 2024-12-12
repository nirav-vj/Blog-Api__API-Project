<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResources;
use App\Http\Resources\CategoriResources;
use App\Http\Resources\HomeblogResources;
use App\Http\Resources\HomeResources;
use App\Models\Blog;
use App\Models\Categori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $categories = Categori::latest()->take(10)->get(); 
        $categoriesCount = Categori::count(); 
        
        $blogs = Blog::latest()->take(10)->get(); 
        $blogsCount = Blog::count(); 

        
        $response = [
            
            'categories_count' => $categoriesCount,
            'categories' => HomeResources::collection($categories),
            'blogs_count' => $blogsCount,
            'blogs' => HomeblogResources::collection($blogs), 
        ];

        return response()->json($response);
    }

    public function bloguser($id)
    {
        $home = Blog::find($id);
        return new HomeblogResources($home);
        
    }
}