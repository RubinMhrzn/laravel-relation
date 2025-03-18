<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'color' => $request->color,
            'price' => $request->price
        ]);

        $categoryIds = $request->category_ids;

        if ($product && $categoryIds) {
            $product->categories()->sync($categoryIds);
        }

        return redirect()->to('product');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $product = Product::whereSlug($slug)->first();

        $categories = Category::all();

        $selectedCategories = $product->categories->pluck('id')->toArray();

        return view('product.edit', compact('product', 'selectedCategories', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $slug)
    {
        $product = Product::findOrFail($slug);

        $product->update([
            'name' => $request->name,
            'color' => $request->color,
            'price' => $request->price,
        ]);

        $product->categories()->sync($request->category_ids);

        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $slug)
    {
        $product = Product::whereSlug($slug)->first();

        $product->categories()->detach();

        $product->delete();

        return redirect()->to('product');
    }
}
