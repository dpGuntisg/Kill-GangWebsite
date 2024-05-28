<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YoutubeLink;

class YoutubeLinkController extends Controller
{
    public function getYoutubeLink()
    {
        $link = YoutubeLink::first();
        return response()->json(['youtubeLink' => $link->url]);
    }

    public function updateYoutubeLink(Request $request)
    {
        $request->validate([
            'youtubeLink' => 'required|url'
        ]);

        $link = YoutubeLink::first();
        if (!$link) {
            $link = new YoutubeLink();
        }
        $link->url = $request->youtubeLink;
        $link->save();

        return response()->json(['message' => 'YouTube link updated successfully']);
    }
}
