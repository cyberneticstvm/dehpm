<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Hsn;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function edit(Request $request)
    {
        $data = collect();
        if ($request->model == 'branch'):
            $data = Branch::find($request->id);
        endif;
        return response()->json([
            'data' => $data,
            'status' => 'success'
        ]);
    }

    function hsn()
    {
        $data = Hsn::orderBy('name')->get();
        return response()->json([
            'data' => $data,
            'status' => 'success'
        ]);
    }

    function products(Request $request)
    {
        $data = Product::where('hsn_id', $request->hsn)->orderBy('name')->get();
        return response()->json([
            'data' => $data,
            'status' => 'success'
        ]);
    }
}
