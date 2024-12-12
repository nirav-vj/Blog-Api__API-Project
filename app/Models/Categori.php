<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    
    use HasFactory;
    protected $table ="categori";
    protected $primarykey ="id";

    protected $fillable = [
        'name',
        'categori_image',
    ];
    
      public function blog(){
        return $this->hasOne(Blog::class,'categori_id');
    }
}