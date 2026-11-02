<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('sku', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('category', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        // Summary Cards
        $totalProducts = Product::count();

        $totalValue = Product::selectRaw(
            'COALESCE(SUM(price * stock), 0) as total'
        )->value('total');

        $lowStock = Product::whereBetween('stock', [1, 5])->count();

        $outOfStock = Product::where('stock', 0)->count();

        return view('products.index', compact(
            'products',
            'totalProducts',
            'totalValue',
            'lowStock',
            'outOfStock'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'sku' => 'required|string|max:32|unique:products,sku',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Save to database
        Product::create($validated);

        // Redirect
        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:32|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
