<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
  use HasFactory;

  protected $guarded = [
    'id'
  ];

  public function area()
  {
    return $this->belongsTo('App\Models\Area');
  }

  public function genre()
  {
    return $this->belongsTo('App\Models\Genre');
  }

  public function favorites()
  {
    return $this->hasMany('App\Models\Favorite')->where('user_id', Auth::id());
  }
}
