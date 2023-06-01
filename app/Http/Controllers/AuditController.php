<?php

namespace App\Http\Controllers;

use App\Models\AuditX;
use Illuminate\Http\Request;

use DB;

class AuditController extends Controller
{
    public function index()
    {

        $audits = AuditX::with("user")->latest()->paginate();

        return view('audit.index', compact('audits'));
    }
}
