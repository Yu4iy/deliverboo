<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'price',
        'image',
        'is_visible',
        'slug',
        'user_id',
    ];
    
    public function orders() {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }
	 public function user() {
		return $this->belongsTo('App\User');
  }
}