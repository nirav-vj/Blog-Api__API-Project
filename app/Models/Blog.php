<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
       use HasFactory;
    protected $table ="blogs";
    protected $primarykey ="id";

    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'tag_id',
        'categori_id',
        'status',
        'date',
        'image',
        'description',
    ];

      public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function categori(){
        return $this->belongsTo(Categori::class,'categori_id');
    }

     public function tag(){
        return $this->belongsTo(Tag::class,);
    }
}