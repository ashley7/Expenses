<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseAccount;

class ExpenseController extends Controller
{
 
    public function index()
    {
        return view("expense.list")->with(['expense'=>Expense::all(),'title'=>'All the expenses']);
    }

  
    public function create()
    {
        return view("expense.create")->with(['account'=>ExpenseAccount::all()]);
    }

 
    public function store(Request $request)
    {
        $save_expense = new Expense($request->all());
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_expense->date=date_timestamp_get($to_date);
        try {
             $save_expense->save();
        } catch (\Exception $e) {}
        return redirect("expense");
    }

 
    public function show($id)
    {
   
    }

  
    public function edit($id)
    {
      
    }

  
    public function update(Request $request, $id)
    {
    
    }
 
    public function destroy($id)
    {
  
    }
}