<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopeeController extends Controller
{
    public function index(Request $request)
    {
        dd($request->all());
        return response()->json([
            'message' => 'Verification successful',
        ], 200);
    }
}
