<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
         $user = Auth::user();
        return new UserResources( $user);
    }
}