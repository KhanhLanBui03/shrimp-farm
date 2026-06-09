<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('audit-logs.index', compact('auditLogs'));
    }
}
