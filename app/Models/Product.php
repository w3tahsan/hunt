<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function rel_to_cat(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    function rel_to_inventory(){
        return $this->hasMany(Inventory::class, 'product_id');
    }
}
