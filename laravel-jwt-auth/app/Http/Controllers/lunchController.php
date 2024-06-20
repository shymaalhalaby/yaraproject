<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use Illuminate\Http\Request;

class lunchController extends Controller
{
    public function index()
    {
        $Lunches = Lunch::all();

        // Return as a JSON response
        return response()->json($Lunches);

}
}
