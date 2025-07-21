<?php

namespace App\Http\Controllers;

use App\Models\Retrieve;
use Illuminate\Http\Request;

class RetrievesController extends Controller
{
    public function show()
    {
        $retrieves = Retrieve::all();
        return view('retrieve', compact('retrieves'));
    }
}
