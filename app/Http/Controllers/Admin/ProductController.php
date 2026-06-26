<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orderBy('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'search' => $request->string('search'),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => Category::orderBy('name')->get(),
            'subcategories' => Product::whereNotNull('subcategory')
                ->distinct()
                ->orderBy('subcategory')
                ->pluck('subcategory'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['marked_price'] = $data['marked_price'] ?: 0;
        $data['quantity'] = $data['quantity'] ?: 0;
        $data['subcategory'] = $data['subcategory'] ?: null;
        $data['meta_description'] = $data['meta_description'] ?: null;
        $data['description'] = $data['description'] ?: null;
        $data['google_merchant'] = $request->boolean('google_merchant');

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'subcategories' => Product::whereNotNull('subcategory')
                ->distinct()
                ->orderBy('subcategory')
                ->pluck('subcategory'),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['marked_price'] = $data['marked_price'] ?: 0;
        $data['quantity'] = $data['quantity'] ?: 0;
        $data['subcategory'] = $data['subcategory'] ?: null;
        $data['meta_description'] = $data['meta_description'] ?: null;
        $data['description'] = $data['description'] ?: null;
        $data['google_merchant'] = $request->boolean('google_merchant');

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $id = $product?->id ?? 'NULL';

        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.$id],
            'price' => ['required', 'numeric', 'min:0'],
            'marked_price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'subcategory' => ['nullable', 'string', 'max:255'],
            'google_merchant' => ['nullable', 'boolean'],
            'image' => ['nullable', 'url', 'max:2048'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'meta_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
