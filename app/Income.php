<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

	protected $fillable = ['voucher_number','amount','particular','incomeaccount_id','phone_number','person_name'];


    public function incomeaccount()
    {
    	return $this->belongsTo('App\IncomeAccount');
    }
}
