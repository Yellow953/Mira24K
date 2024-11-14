<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Category;
use App\Models\JewelryModel;
use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'title', 'price', 'category_id', 'jewelry_model_id')
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view('app.products.index', compact('products'));
    }

    public function new()
    {

        $jewelryModels = JewelryModel::all();
        $categories = Category::all();

        return view('app.products.new', compact('jewelryModels', 'categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'jewelry_model_id' => 'required|exists:jewelry_models,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'mcode' => 'required|string|max:255|unique:products',
            'karat' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'required|image',
            'secondary_image_1' => 'nullable|image',
            'secondary_image_2' => 'nullable|image',
            'secondary_image_3' => 'nullable|image',
        ]);

        $productData = $request->all();
        $productData['image'] = $request->file('image')->store('images', 'public');
        $productData['secondary_image_1'] = $request->file('secondary_image_1')->store('images', 'public');
        $productData['secondary_image_2'] = $request->file('secondary_image_2')->store('images', 'public');
        $productData['secondary_image_3'] = $request->file('secondary_image_3')->store('images', 'public');

        $product = Product::create($productData);

        Log::create([
            'text' => ucwords(auth()->user()->name) . " created Product: " . $product->title . ", datetime: " . now(),
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $jewelryModels = JewelryModel::all();
        $categories = Category::all();
        $data = compact('product', 'jewelryModels', 'categories');

        return view('app.products.edit', $data);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'jewelry_model_id' => 'required|exists:jewelry_models,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'mcode' => 'required|string|max:255|unique:products,mcode,' . $product->id,
            'karat' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'secondary_image_1' => 'nullable|image',
            'secondary_image_2' => 'nullable|image',
            'secondary_image_3' => 'nullable|image',
        ]);

        $updatedData = $request->only([
            'jewelry_model_id', 'category_id', 'title', 'mcode', 'karat', 'weight', 'price', 'compare_price', 'description'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $updatedData['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('secondary_image_1')) {
            Storage::disk('public')->delete($product->secondary_image_1);
            $updatedData['secondary_image_1'] = $request->file('secondary_image_1')->store('images', 'public');
        }
        if ($request->hasFile('secondary_image_2')) {
            Storage::disk('public')->delete($product->secondary_image_2);
            $updatedData['secondary_image_2'] = $request->file('secondary_image_2')->store('images', 'public');
        }
        if ($request->hasFile('secondary_image_3')) {
            Storage::disk('public')->delete($product->secondary_image_3);
            $updatedData['secondary_image_3'] = $request->file('secondary_image_3')->store('images', 'public');
        }

        $product->update($updatedData);

        Log::create([
            'text' => ucwords(auth()->user()->name) . " updated Product: " . $product->title . ", datetime: " . now(),
        ]);

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $text = ucwords(auth()->user()->name) . " deleted Product: " . $product->title . ", datetime: " . now();

        Log::create([
            'text' => $text,
        ]);

        $product->delete();

        return redirect()->back()->with('error', 'Product deleted successfully!');
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
