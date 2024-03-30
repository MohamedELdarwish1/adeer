<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'auction_id' => 'required|exists:auctions,id',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $auction = Auction::findOrFail($request->auction_id);
        if (!$auction->is_active) {
            return response()->json(['message' => 'You Can`t bid on this auction'], 403);
        }

        $bid = Bid::create($request->all());

        return response()->json(['message' => 'Bid placed successfully', 'bid' => $bid], 200);
    }

}
