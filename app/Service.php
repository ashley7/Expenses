<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function income_account()
    {
        return $this->belongsTo(IncomeAccount::class,'incomeaccount_id');
    }
}
