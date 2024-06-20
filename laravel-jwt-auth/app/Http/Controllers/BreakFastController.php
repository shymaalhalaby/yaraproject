<?php

namespace App\Http\Controllers;

use App\Models\BreakFast;
use Illuminate\Http\Request;

class BreakFastController extends Controller
{
    public function index()
    {
        $breakFasts = BreakFast::all();

        // Return as a JSON response
        return response()->json($breakFasts);

}}
