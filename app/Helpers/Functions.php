<?php

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

function humanize_date($date)
{
    return $date ? Carbon::parse($date)->format('d M Y') : null;
}

function generateProductCode($product)
{
    $code = Str::upper(
        // substr(preg_replace('/[^A-Z0-9]/', '', $product->brand?->name), 0, 3) .
        substr(preg_replace('/[^A-Z0-9]/', '', $product->name), 0, 3) .
            Str::random(6)
    );
    if (Product::where('code', $code)->exists()) {
        return generateProductCode($product);
    }
    return $code;
}
