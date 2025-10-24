<?php

namespace App\Models;

class Order
{
    public function calculateTotal($items)
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        $discount = 0;
        if ($subtotal > 1000000) {
            $discount = $subtotal * 0.1;
        }

        $total = $subtotal - $discount;

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total
        ];
    }
}
