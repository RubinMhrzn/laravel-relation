<?php

namespace App\Models;

use App\Traits\HasSlugAndUuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlugAndUuid;
    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }
}
