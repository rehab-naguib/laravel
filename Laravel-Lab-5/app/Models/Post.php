<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
  use HasFactory;
  use Sluggable;

  protected $fillable = ["title","discription","slug","user_id"];

  public function sluggable():array{
    return[
      'slug' => [
          'source' => 'title'
        ]
      ];
  }
  function user(){
    return $this->belongsTo(User::class);
  }

}