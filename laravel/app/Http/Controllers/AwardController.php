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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string'
        ]);

        $award = Award::create($validatedData);

        return response()->json(['message' => 'Award created successfully', 'award' => $award]);
    }
}