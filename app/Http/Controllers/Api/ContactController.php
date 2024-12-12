<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResources;
use App\Models\Contact;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request,)
    {
        $request -> validate([
           'name' => 'required|max:255',
           'email'=> 'required|email',
           'message'=>'required',
        ]);

        $input = $request->all();
        $contact = Contact::create($input);
        return new ContactResources($contact);
    }

    public function index()
    {
        $contact = Contact::all();
        return ContactResources::collection($contact);
    }
}