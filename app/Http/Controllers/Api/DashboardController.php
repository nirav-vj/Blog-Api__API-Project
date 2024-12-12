<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bloguser;
use App\Models\Categori;
use App\Models\Contact;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
       
         $counts = [
            'tags' => Tag::count(),
            'blogs' => Blog::count(),
            'contacts' => Contact::count(),
            'categories' => Categori::count(),
            'users' => User::count(),
    ];

    return response()->json($counts);
    }
}