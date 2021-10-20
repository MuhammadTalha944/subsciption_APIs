<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions;
use Validator;

class SubsriptionsController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:subscriptions',
        ], 
            [
            'email.unique' => 'You have already subscribed!',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => false,
                "message" => "Validation Errors",
                "data" => $validator->errors()
            ]);
        }

        $post = Subscriptions::create($input);
        return response()->json([
            "success" => true,
            "message" => "Subsribed successfully."
        ]);
    } 
}
