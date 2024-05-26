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
        $member = Member::findOrFail($id);
        $member->update($request->all());

        return response()->json(['message' => 'Member updated successfully']);
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return response()->json(['message' => 'Member deleted successfully']);
    }
}
