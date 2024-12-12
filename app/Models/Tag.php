<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     use HasFactory;
    protected $table ="tags";
    protected $primarykey ="id";

    protected $fillable = [
        'name',
    ];

      public function blog(){
        return $this->hasMany(Blog::class,);
    }
}