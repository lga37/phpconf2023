<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','price', 'category_id','img'];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }
}
