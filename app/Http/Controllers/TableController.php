<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class TableController extends Controller
{
    // Show table view with data
    public function index()
    {
        // Correct the path to 'admin.table' for views in resources/views/admin
        return view('admin.table'); // This will look for resources/views/admin/table.blade.php
    }
}
