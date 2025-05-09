<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::all()->makeHidden(['created_at', 'updated_at']);

      
        $aboutUs->transform(function ($item) {
            if ($item->image) {
                $item->image =' /storage/' . $item->image;
            }
            return $item;
        });

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $aboutUs
        ], 200);
    }

    public function show($id)
    {
        $about = AboutUs::find($id);

        if (!$about) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Record not found'
            ], 404);
        }

        $about->makeHidden(['created_at', 'updated_at']);

        if ($about->image) {
            $about->image =' /storage/' . $about->image;
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $about
        ], 200);
    }
}
