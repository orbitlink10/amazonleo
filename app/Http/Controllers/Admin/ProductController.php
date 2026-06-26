<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private array $productCategorySlugs = [
        'where-to-buy-starlink-in-kenya',
        'isp-billing-software',
        'starlink-extension',
        'starlink-accesories',
        'starlink-kenya-packages',
        'starlink-kenya-price',
    ];

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
            'categories' => Category::whereIn('slug', $this->productCategorySlugs)->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
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
            'categories' => Category::whereIn('slug', $this->productCategorySlugs)->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product);
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
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
            'google_merchant' => ['nullable', 'boolean'],
            'image' => ['nullable', 'url', 'max:2048'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
