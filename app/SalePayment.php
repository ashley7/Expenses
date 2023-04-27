<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SalePayment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function savePayment($amount,$sale_id)
    {
        $savePayment = new SalePayment();

        $savePayment->amount = $amount;

        $savePayment->sale_id = $sale_id;

        $savePayment->user_id = Auth::id();

        $savePayment->save();

        return $savePayment;
    }
}
