<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Category;
use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'title', 'mcode', 'price', 'category_id', 'karat', 'weight', 'image')->filter()->orderBy('id', 'desc')->paginate(25);
        $categories = Category::select('id', 'name')->where('type', 'products')->get();

        $data = compact('products', 'categories');
        return view('app.products.index', $data);
    }

    public function new()
    {
        $categories = Category::select('id', 'name')->where('type', 'products')->get();

        return view('app.products.new', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $image_path = '/uploads/products/' . $filename;
            $productData['image'] = $image_path;
        }
        if ($request->hasFile('secondary_image_1')) {
            $file = $request->file('secondary_image_1');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_1_path = '/uploads/products/' . $filename;
            $productData['secondary_image_1'] = $secondary_image_1_path;
        }
        if ($request->hasFile('secondary_image_2')) {
            $file = $request->file('secondary_image_2');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_2_path = '/uploads/products/' . $filename;
            $productData['secondary_image_2'] = $secondary_image_2_path;
        }
        if ($request->hasFile('secondary_image_3')) {
            $file = $request->file('secondary_image_3');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_3_path = '/uploads/products/' . $filename;
            $productData['secondary_image_3'] = $secondary_image_3_path;
        }

        $product = Product::create($productData);

        Log::create([
            'text' => ucwords(auth()->user()->name) . " created Product: " . $product->title . ", datetime: " . now(),
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->where('type', 'products')->get();

        $data = compact('product', 'categories');
        return view('app.products.edit', $data);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
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
            'category_id',
            'title',
            'mcode',
            'karat',
            'weight',
            'price',
            'compare_price',
            'description'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $image_path = '/uploads/products/' . $filename;
            $updatedData['image'] = $image_path;
        }
        if ($request->hasFile('secondary_image_1')) {
            $file = $request->file('secondary_image_1');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_1_path = '/uploads/products/' . $filename;
            $updatedData['secondary_image_1'] = $secondary_image_1_path;
        }
        if ($request->hasFile('secondary_image_2')) {
            $file = $request->file('secondary_image_2');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_2_path = '/uploads/products/' . $filename;
            $updatedData['secondary_image_2'] = $secondary_image_2_path;
        }
        if ($request->hasFile('secondary_image_3')) {
            $file = $request->file('secondary_image_3');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $secondary_image_3_path = '/uploads/products/' . $filename;
            $updatedData['secondary_image_3'] = $secondary_image_3_path;
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
