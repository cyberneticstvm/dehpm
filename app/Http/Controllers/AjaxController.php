<?php

namespace App\Http\Controllers;

use App\Models\Branch;
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
}
