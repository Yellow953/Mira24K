<?php

namespace App\Http\Controllers;

use App\Exports\ResellersExport;
use App\Models\Reseller;
use App\Models\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResellerController extends Controller
{
    public function index()
    {
        $resellers = Reseller::select('id', 'name', 'address', 'gsm', 'phone', 'email', 'contact_person')->filter()->orderBy('id', 'desc')->paginate(25);

        return view('app.resellers.index', compact('resellers'));
    }

    public function new()
    {
        return view('app.resellers.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gsm' => 'required|string|max:15',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:resellers,email',
            'contact_person' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Reseller::create($request->only([
            'name',
            'address',
            'gsm',
            'phone',
            'email',
            'contact_person',
            'notes'
        ]));

        $text = auth()->user()->name . " created Reseller : " . $request->name . ", datetime : " . now();
        Log::create(['text' => $text]);

        return redirect()->route('resellers')->with('success', 'Reseller created successfully!');
    }

    public function edit(Reseller $reseller)
    {
        return view('app.resellers.edit', compact('reseller'));
    }

    public function update(Reseller $reseller, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gsm' => 'required|string|max:15',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:resellers,email,' . $reseller->id,
            'contact_person' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $originalName = $reseller->name;
        $reseller->update($request->only([
            'name',
            'address',
            'gsm',
            'phone',
            'email',
            'contact_person',
            'notes'
        ]));

        $text = auth()->user()->name . ' updated Reseller ' . $originalName . ' to ' . $request->name . ", datetime : " . now();
        Log::create(['text' => $text]);

        return redirect()->route('resellers')->with('success', 'Reseller updated successfully!');
    }

    public function destroy(Reseller $reseller)
    {
        $text = auth()->user()->name . " deleted Reseller : " . $reseller->name . ", datetime : " . now();
        Log::create(['text' => $text]);

        $reseller->delete();

        return redirect()->back()->with('error', 'Reseller deleted successfully!');
    }

    public function export()
    {
        return Excel::download(new ResellersExport, 'resellers.xlsx');
    }
}
