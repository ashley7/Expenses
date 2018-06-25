<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['voucher_number','amount','particular','expense_account_id'];

    public function expenseaccount()
    {
    	return $this->belongsTo('App\ExpenseAccount','expense_account_id');
    }
}
