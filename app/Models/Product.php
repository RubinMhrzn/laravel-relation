<?php

namespace App\Models;

use App\Traits\HasSlugAndUuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name',
    //     'color',
    //     'price'
    // ];
    use HasSlugAndUuid;
    protected $guarded = ['id'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
            ->when($filters['category'] ?? false, function ($query, $category) {
                return $query->whereHas('categories', function ($query) use ($category) {
                    $query->whereIn('slug', $category);
                });
            });
    }
}
