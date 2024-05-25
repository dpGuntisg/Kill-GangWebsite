<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;

class AwardController extends Controller
{
    public function index()
    {
        return Award::with('image')->get();
    }

    public function update(Request $request, $id)
    {
        $award = Award::findOrFail($id);
        $award->update($request->all());

        return response()->json(['message' => 'Award updated successfully']);
    }
}