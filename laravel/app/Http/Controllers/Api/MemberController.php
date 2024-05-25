<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return Member::with('image')->get();
    }

    public function update(Request $request, $id)
    {
        $award = Member::findOrFail($id);
        $award->update($request->all());

        return response()->json(['message' => 'Member updated successfully']);
    }  
}
