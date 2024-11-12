<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email')->filter()->orderBy('id', 'desc')->paginate(25);

        return view('app.users.index', compact('users'));
    }

    public function new()
    {
        $permissions = Permission::all();
        return view('app.users.new', compact('permissions'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|max:255|confirmed',
        ]);

        User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
        ]);

        $text = ucwords(auth()->user()->name) . " created User : " . $request->name . ", datetime :   " . now();
        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('users')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('name')->toArray();

        $data = compact('user', 'permissions', 'userPermissions');
        return view('app.users.edit', $data);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'name' => trim($request->name),
            'email' => trim($request->email),
        ]);

        if ($user->name != trim($request->name)) {
            $text = ucwords(auth()->user()->name) . ' updated User ' . $user->name . " to " . $request->name . ", datetime :   " . now();
        } else {
            $text = ucwords(auth()->user()->name) . ' updated User ' . $user->name . ", datetime :   " . now();
        }

        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('users')->with('success', 'User created successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->can_delete()) {
            $text = ucwords(auth()->user()->name) . " deleted user : " . $user->name . ", datetime :   " . now();

            Log::create([
                'text' => $text,
            ]);
            $user->delete();

            return redirect()->back()->with('error', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Unothorized Access...');
        }
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
