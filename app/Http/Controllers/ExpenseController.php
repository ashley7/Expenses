<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseAccount;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        return view("expense.list")->with(['expense'=>Expense::all(),'title'=>'All the expenses','accounts'=>ExpenseAccount::all(),'account_title'=>'Expense Account summery']);
    }

  
    public function create()
    {
        return view("expense.create")->with(['account'=>ExpenseAccount::orderBy('name','ASC')->get()]);
    }

 
    public function store(Request $request)
    {
        $this->validate($request,["date"=>"required","voucher_number"=>"required","amount"=>"required|numeric","particular"=>"required","expense_account_id"=>"required"]);
        
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