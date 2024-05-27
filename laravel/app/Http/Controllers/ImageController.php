<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Award;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('images', $filename, 'public');

        $imageModel = new Image();
        $imageModel->filename = $filename;
        $imageModel->filepath = $path;
        $imageModel->save();

        return response()->json(['message' => 'Image uploaded successfully', 'image' => $imageModel]);
    }


}