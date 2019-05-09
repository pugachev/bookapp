<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = ['title','image_url'];
  public function comments() {
    return $this->hasMany('App\Comment');
  }
}
