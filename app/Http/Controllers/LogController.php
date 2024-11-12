<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
use App\Models\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::select('text', 'created_at')->filter()->orderBy('created_at', 'desc')->paginate(25);

        return view('logs.index', compact('logs'));
    }

    public function export()
    {
        return Excel::download(new LogExport, 'logs.xlsx');
    }
}
