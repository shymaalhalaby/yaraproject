<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MultipleUploadController extends Controller
{

    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,gif,jpeg,mp4',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ]);
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;

        // Check if the file was moved successfully
        if (!$img->move(public_path() . '/uploads', $imageName)) {
            return response()->json([
                'status' => false,
                'message' => 'File could not be saved',
            ]);
        }

        $image = new Image; // Assuming you have an Image model linked to your database
        $image->image = $imageName; // The filename

        $image->save(); // Save the record to the database

        return response()->json([
            'status' => true,
            'message' => 'File uploaded successfully',
            'path' => asset('/uploads/' . $imageName),
            'data' => $image

        ]);
    }
    public function getImageById($image_id) {
        // Find the image by its id
        $image = Image::find($image_id);

        // Check if the image was found
        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found',
            ]);
        }

        // Optionally, generate a full URL to the image
        $image->path = asset('/uploads/' . $image->image);

        // Return a JSON response with the image data
        return response()->json([
            'status' => true,
            'message' => 'Image retrieved successfully',
            'data' => $image,
        ]);
    }


    }









