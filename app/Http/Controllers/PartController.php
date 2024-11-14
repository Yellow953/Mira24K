<?php

namespace App\Http\Controllers;

use App\Exports\PartExport;
use App\Models\Category;
use App\Models\Log;
use App\Models\Part;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::select('category_id', 'reseller_id', 'image', 'name', 'mcode')->filter()->orderBy('id', 'desc')->paginate(25);
        $categories = Category::select('id', 'name')->where('type', 'parts')->get();
        $resellers = Reseller::select('id', 'name')->get();

        $data = compact('parts', 'categories', 'resellers');
        return view('app.parts.index', $data);
    }

    public function new()
    {
        $categories = Category::select('id', 'name')->where('type', 'parts')->get();
        $resellers = Reseller::select('id', 'name')->get();

        $data = compact('categories', 'resellers');
        return view('app.parts.new', $data);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'size' => 'nullable|string|max:50',
            'gr_pcs' => 'nullable|numeric',
            'dollar_gr' => 'nullable|numeric',
            'dollar_pcs' => 'nullable|numeric',
            'group' => 'nullable|string|max:50',
            'mcode' => 'nullable|string|max:50',
            'reseller_id' => 'required|exists:resellers,id',
            'reseller_barcode' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'faceted' => 'nullable|boolean',
            'color' => 'nullable|string|max:50',
            'stone_pack' => 'nullable|numeric',
            'role' => 'nullable|boolean',
            'thickness' => 'nullable|numeric',
            'gr_dm' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/parts/', $filename);
            $image_path = '/uploads/parts/' . $filename;
            $validatedData['image'] = $image_path;
        }

        $validatedData['faceted'] = $request->has('faceted') ?? null;
        $validatedData['role'] = $request->has('role') ?? null;

        Part::create($validatedData);

        $text = ucwords(auth()->user()->name) . " created Part : " . $request->name . ", datetime : " . now();
        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('parts')->with('success', 'Part created successfully.');
    }


    public function edit(Part $part)
    {
        $categories = Category::select('id', 'name')->where('type', 'parts')->get();
        $resellers = Reseller::select('id', 'name')->get();

        $data = compact('categories', 'part', 'resellers');
        return view('parts.edit', $data);
    }

    public function update(Request $request, Part $part)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'size' => 'nullable|string|max:50',
            'gr_pcs' => 'nullable|numeric',
            'dollar_gr' => 'nullable|numeric',
            'dollar_pcs' => 'nullable|numeric',
            'group' => 'nullable|string|max:50',
            'mcode' => 'nullable|string|max:50',
            'reseller_id' => 'required|exists:resellers,id',
            'reseller_barcode' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
            'faceted' => 'nullable|boolean',
            'color' => 'nullable|string|max:50',
            'stone_pack' => 'nullable|numeric',
            'role' => 'nullable|boolean',
            'thickness' => 'nullable|numeric',
            'gr_dm' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/parts/', $filename);
            $image_path = '/uploads/parts/' . $filename;
            $validatedData['image'] = $image_path;
        }

        $validatedData['faceted'] = $request->has('faceted') ?? $part->faceted;
        $validatedData['role'] = $request->has('role') ?? $part->role;

        $part->update($validatedData);

        $text = ucwords(auth()->user()->name) . " updated Part : " . $request->name . ", datetime :   " . now();
        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('parts')->with('success', 'Part updated successfully.');
    }

    public function destroy(Part $part)
    {
        $text = ucwords(auth()->user()->name) . " deleted Part : " . $part->name . ", datetime :   " . now();

        Log::create([
            'text' => $text,
        ]);
        $part->delete();

        return redirect()->route('parts')->with('success', 'Part deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new PartExport, 'parts.xlsx');
    }
}
