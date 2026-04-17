<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $inquiry = new Inquiry();
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->subject = $request->subject;
        $inquiry->message = $request->message;
        $inquiry->save();
        
        return response()->json(['message' => 'Success']);
    }
}
