<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
  
    public function index()
    {
        $contacts = ContactUs::all()->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $contacts
        ], 200);
    }

    public function show($id)
    {
        $contact = ContactUs::find($id);

        if (!$contact) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Record not found'
            ], 404);
        }

        $contact->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $contact
        ], 200);
    }
}
