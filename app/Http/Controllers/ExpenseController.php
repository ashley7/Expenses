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
        return view("expense.list")->with(['expense'=>Expense::orderBy('id','ASC')->paginate(100),'title'=>'All the expenses','accounts'=>ExpenseAccount::all(),'account_title'=>'Expense Account summery']);
    }

  
    public function create()
    {
        return view("expense.create")->with(['account'=>ExpenseAccount::orderBy('name','ASC')->get()]);
    }

 
    public function store(Request $request)
    {
 
        $this->validate($request,["date"=>"required","amount"=>"required","expense_account_id"=>"required"]);
        
        $save_expense = new Expense($request->all());

        $to_date = date_create(str_replace("/", "-", $request->date));

        $save_expense->date=date_timestamp_get($to_date);

        $save_expense->amount=(double)str_replace(",", "", $request->amount);

        if (empty($request->voucher_number)) 

            $save_expense->voucher_number=time();

        else
        
            $save_expense->voucher_number=$request->voucher_number;

        try {
             $save_expense->save();
             echo "Saved";
        } catch (\Exception $e) {
             echo $e->getMessage();
        }
        // return redirect("expense");
    }

 
    public function show($id)
    {
   
    }

  
    public function edit($id)
    {
      return view("expense.edit")->with(["expense"=>Expense::find($id),"account"=>ExpenseAccount::orderBy('name','ASC')->get()]);
    }

  
    public function update(Request $request, $id)
    {
        $save_expense = Expense::find($id);
        if (!empty($request->date)) {
           $to_date = date_create(str_replace("/", "-", $request->date));
           $save_expense->date=date_timestamp_get($to_date);
        }

        if (!empty($request->voucher_number)) {
            $save_expense->voucher_number=$request->voucher_number;
        }
        if (!empty($request->phone_number)) {
           $save_expense->phone_number=$request->phone_number;
       }

       if (!empty($request->person_name)) {
           $save_expense->person_name=$request->person_name;
       }

       if (!empty($request->amount)) {
          $save_expense->amount = (double)str_replace(",", "", $request->amount);
       }

       if (!empty($request->particular)) {
           $save_expense->particular = $request->particular;
       }

       if (!empty($request->expense_account_id)) {
           $save_expense->expense_account_id=$request->expense_account_id;
       }
        
        try {
             $save_expense->save();
        } catch (\Exception $e) {}
        return redirect("expense");
    }
 
    public function destroy($id)
    {
        try {
            Expense::destroy($id);
        } catch (\Exception $e) {
            
        }

        return back()->with(["status"=>"Operation successfull"]);
    }

    
    public function searchRecord(Request $request)
    {

        $search_text = $request->search_text;

        if(empty($search_text)) return back();

        $expenses = Expense::where('voucher_number','LIKE','%'.$search_text.'%')
                            ->orWhere('phone_number','LIKE','%'.$search_text.'%') 
                            ->orWhere('person_name','LIKE','%'.$search_text.'%') 
                            ->orWhere('particular','LIKE','%'.$search_text.'%') 
                            ->orWhere('id','LIKE','%'.$search_text.'%') 
                            ->paginate(100);

        $accounts = ExpenseAccount::where('name','LIKE','%'.$search_text.'%')->paginate(100);

        $total = $expenses->sum('amount');

        $data = [
            'expense'=>$expenses,
            'title'=>'Search results for '.$search_text,
            'accounts'=>$accounts,
            'account_title'=>'Expense Account summery',
            'total_expenses' => $total,
          ];

        return view("expense.list")->with($data);

    }
}