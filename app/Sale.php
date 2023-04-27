<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public static function cost($sale_id)
    {

        return SaleDetail::where('sale_id',$sale_id)->sum('amount');

    }

    public static function paid($sale_id)
    {

        return SalePayment::where('sale_id',$sale_id)->sum('amount');        

    }

    public static function discounts($sale_id)
    {

        return SaleDetail::where('sale_id',$sale_id)->sum('discount');        

    }

    public static function balance($sale_id)
    {
        $balance = Sale::cost($sale_id)-Sale::paid($sale_id);

        return $balance;

        // return $balance - Sale::discounts($sale_id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
