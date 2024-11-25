<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TableController extends Controller
{
    // Show table view with data
    public function index()
    {
        // Correct the path to 'admin.table' for views in resources/views/admin
        return view('admin.table'); // This will look for resources/views/admin/table.blade.php
    }
}