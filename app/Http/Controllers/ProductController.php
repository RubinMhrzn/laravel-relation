<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
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
        $products = Product::withTrashed()->with('variants', 'categories')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', [
            'categories' => Category::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $productData = [
            'name' => $request->name,
            'description' => $request->description ?? null,
            'specification' => $request->specification ?? null,
            'features' => $request->features ?? null,
            'brand' => $request->brand ?? null,
            'summary' => $request->summary ?? null,
            'addedable_type' => 'App\Models\Admin',
            'addedable_id' => 1,
        ];

        // dd($productData);

        $product = Product::create($productData);

        if ($request->filled('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'color_id' => $variant['color_id'] ?? null,
                    'size_id' => $variant['size_id'] ?? null,
                    'is_parent' => $variant['is_parent'],
                    'price' => $variant['price'],
                    'base_price' => $variant['base_price'],
                    'stock' => $variant['stock'] ?? 0,
                    'status' => true,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
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
        $product = Product::with('variants')->whereSlug($slug)->firstOrFail();

        return view('product.edit', [
            'product' => $product,
            'selectedCategories' => $product->categories->pluck('id')->toArray(),
            'categories' => Category::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $slug)
    {
        $product = Product::whereSlug($slug)->firstOrFail();

        $product->update([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'specification' => $request->specification ?? null,
            'features' => $request->features ?? null,
            'brand' => $request->brand ?? null,
            'summary' => $request->summary ?? null,
        ]);

        if ($request->filled('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        $product->variants()->delete();

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'color_id' => $variant['color_id'] ?? null,
                    'size_id' => $variant['size_id'] ?? null,
                    'is_parent' => $variant['is_parent'] ?? 0,
                    'price' => $variant['price'],
                    'base_price' => $variant['base_price'],
                    'stock' => $variant['stock'] ?? 0,
                    'status' => true,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $slug)
    {
        $product = Product::whereSlug($slug)->first();

        // $product->categories()->detach();

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function restore($slug = null)
    {
        $query = Product::query();

        if ($slug) {
            $query->whereSlug($slug)->restore();
            return redirect()->back()->with('success', 'Product restored successfully');
        }

        $query->onlyTrashed()->restore();
        return redirect()->back()->with('success', 'Product restored successfully');
    }

    public function productlist(Request $request)
    {
        $filters = $request->filters ?? [];

        $sortDir = $filters['sort_dir'] ?? 'asc';
        $categories = Category::whereHas('products')->get();

        $query = Product::with('categories');

        // Ensure 'search' and 'category' exist before using them
        if (!empty($filters['search']) || !empty($filters['category'])) {
            $query->filter($filters);
        }
        $sortBy = 'name';
        if (!empty($filters['sort'])) {
            if ($filters['sort'] == 'name') {
                $sortBy = 'name';
                $sortDir = 'asc';
            } elseif ($filters['sort'] == 'lowest') {
                $sortBy = 'price';
                $sortDir = 'asc';
            } elseif ($filters['sort'] == 'highest') {
                $sortBy = 'price';
                $sortDir = 'desc';
            } elseif ($filters['sort'] == 'recent') {
                $sortBy = 'created_at';
                $sortDir = 'asc';
            }

            $query->orderBy($sortBy, $sortDir);
        }

        $products = $query->paginate(10);

        return view('product.filterproduct', compact('products', 'categories'));
    }
}
