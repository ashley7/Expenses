<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    public function incomeaccount()
    {
    	return $this->belongsTo('App\IncomeAccount');
    }

    public static function saveIncome($date, $voucher_number,$amount,$incomeaccount_id,$particular,$phone_number,$person_name,$balance=null)
    {
        
        $save_expense = new Income();

        $save_expense->voucher_number = $voucher_number;

        $save_expense->incomeaccount_id = $incomeaccount_id;

        $save_expense->particular = $particular;

        $save_expense->phone_number = $phone_number;

        $save_expense->person_name = $person_name;

        $to_date = date_create(str_replace("/", "-", $date));

        $save_expense->date=date_timestamp_get($to_date);

        $save_expense->amount=(double)str_replace(",", "", $amount);

        $save_expense->balance = $balance;

       $save_expense->save();

       return $save_expense;
             
    }
}
