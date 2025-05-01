<?php

namespace App\Models;

use App\Traits\HasSlugAndUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasSlugAndUuid, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'specification',
        'features',
        'brand',
        'code',
        'summary',
        'addedable_type',
        'addedable_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
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
