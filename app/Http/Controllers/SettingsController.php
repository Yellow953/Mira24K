<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\General;
use App\Models\Log;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $gold_price = General::where('title', 'gold_price')->first();
        $min_gram_profit = General::where('title', 'min_gram_profit')->first()->value;
        $max_gram_profit = General::where('title', 'max_gram_profit')->first()->value;
        $parts_categories = Category::select('id', 'name', 'image')->where('type', 'parts')->get();
        $products_categories = Category::select('id', 'name', 'image')->where('type', 'products')->get();

        $data = compact('gold_price', 'min_gram_profit', 'max_gram_profit', 'parts_categories', 'products_categories');
        return view('app.settings.index', $data);
    }

    public function update_profit(Request $request)
    {
        $request->validate([
            'min_gram_profit' => 'required|min:0',
            'max_gram_profit' => 'required|min:0'
        ]);

        $min_gram_profit = General::where('title', 'min_gram_profit')->first();
        $min_gram_profit->update([
            'value' => $request->min_gram_profit
        ]);

        $max_gram_profit = General::where('title', 'max_gram_profit')->first();
        $max_gram_profit->update([
            'value' => $request->max_gram_profit
        ]);

        Log::create([
            'text' => ucwords(auth()->user()->name) . ' udpated profit margins, datetime: ' . now()
        ]);

        return redirect()->back()->with('success', 'Profit margins updated successfully...');
    }

    public function create_parts_category(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/categories/', $filename);
            $image_path = '/uploads/categories/' . $filename;
        }

        Category::create([
            'type' => 'parts',
            'name' => $request->name,
            'image' => $image_path
        ]);

        Log::create([
            'text' => ucwords(auth()->user()->name) . ' created Parts Category: ' . $request->name . ', datetime: ' . now()
        ]);

        return redirect()->back()->with('success', 'Parts Category created successfully...');
    }

    public function create_products_category(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/categories/', $filename);
            $image_path = '/uploads/categories/' . $filename;
        }

        Category::create([
            'type' => 'products',
            'name' => $request->name,
            'image' => $image_path
        ]);

        Log::create([
            'text' => ucwords(auth()->user()->name) . ' created Products Category: ' . $request->name . ', datetime: ' . now()
        ]);

        return redirect()->back()->with('success', 'Products Category created successfully...');
    }

    public function destroy_category(Category $category)
    {
        $text = ucwords(auth()->user()->name) . " deleted Category : " . $category->name . ", datetime :   " . now();

        Log::create([
            'text' => $text,
        ]);
        $category->delete();

        return redirect()->back()->with('error', 'User deleted successfully!');
    }
}
