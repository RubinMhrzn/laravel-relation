<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name',
    //     'color',
    //     'category',
    //     'price'
    // ];
    protected $guarded = ['id'];
    public function Category()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }
}
