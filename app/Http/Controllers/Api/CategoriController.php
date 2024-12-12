<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriResources;
use Illuminate\Http\Request;
use App\Models\Categori;
use App\Models\User;
use PhpParser\Node\Stmt\Catch_;

class CategoriController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',           
        'categori_image' => 'required|image', 
    ]);

    if ($request->hasFile('categori_image')) {
        $validatedData['categori_image'] = $request->file('categori_image');
    }

    $categori = Categori::create($validatedData);

    return new CategoriResources($categori);
}





    public function index(Request $request)
    {   
              $search = $request['search'] ?? "";
        if ($search != "") {
            $categoris = Categori::where('name', 'like', "%$search%")
                        ->orwhere('categori_image', 'like', "%$search%")
                        ->get();
        } else {
            $categoris = Categori::all();
        }
        
        return CategoriResources::collection($categoris);
    }



    
    public function edit($id)
    {
        $categori = Categori::find($id);
         if($categori == null){
            return 'user not found';
         }

        return $categori;
    }



    
     public function update(Request $request,$id)
    {

        $categori = Categori::find($id);
        $input = $request->all();
        
        if($categori->update($input)){
                return response()->json([
                'message' => 'Your data is updated successfully',
                'categori' => $categori,
            ]);
        }
    } 
    
    

    
    public function delete($id)
    {
        $categori = Categori::find($id);
        $categori->delete();

        return "categori deleted successfully";
        
    }

}