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
    use HasUuids;

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
    public function show($id)
    {
        $product = Product::find($id)->first();
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product            = Product::where('id', $id)->first();
        $selectedCategories = $product->categories->pluck('id')->toArray();

        return view('product.edit', compact('product', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $products = Product::where('id', $id)->first();
        $products->update($request->all());
        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $products = Product::where('id', $id)->first();
        $products->delete($request->all());
        return redirect()->to('product');
    }
}
