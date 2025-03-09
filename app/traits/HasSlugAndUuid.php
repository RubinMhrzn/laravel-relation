<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlugAndUuid
{
    public static function bootHasSlugAndUuid()
    {
        static::creating(function ($model) {
            $slugSource = $model->name ?? $model->title ?? null;

            if (!empty($slugSource) && empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model, $slugSource);
            }
        });
    }

    protected static function generateUniqueSlug($model, $source)
    {
        $slug = Str::slug($source);
        $count = $model->where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
