<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribtion;
class SubscriptionController extends Controller
{
    public function subscribe(Request $request){
        $request->validate([
            'user_id' => 'required | exists:users,id',
            'website_id' => 'required | exists:websites,id',
        ]);
        $exists = Subscribtion::where(['user_id' => $request['user_id']])
            ->where('website_id', $request['website_id'])
            ->exists();
        if ($exists){
            return response()->json(['message' => 'Already subscribed'], 400);
        }
        Subscribtion::create([
            'user_id' => $request['user_id'],
            'website_id' => $request['website_id'],
        ]);
        return response()->json(['message' => 'Subscribtion successfully'], 200);
    }
}
