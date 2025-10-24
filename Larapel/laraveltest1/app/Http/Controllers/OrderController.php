<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function total(Request $request)
    {
        $items = $request->input('items', []);
        $order = new Order();
        $result = $order->calculateTotal($items);
        return response()->json($result);
    }
}