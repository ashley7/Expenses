<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomeAccount;
use App\Income;

class IncomeAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_title="List of all account Incomes";
        $item_title="Account summery";
        return view("income.account")->with(["accounts"=>IncomeAccount::get(),"expense_title"=>$expense_title,"item_title"=>$item_title,'title'=>'']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view("income.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_expenseaccount = new IncomeAccount($request->all());
        try {
            $save_expenseaccount->save();
        } catch (\Exception $e) {}
        return redirect("income_account");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account=IncomeAccount::find($id);
        $title="All Incomes in ".$account->name;
        return view("income.incomes")->with(['income'=>Income::where('incomeaccount_id',$id)->paginate(100),'title'=>$title,'account_title'=>'',"accounts"=>IncomeAccount::get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("income.edit_account")->with(['expense_account'=>IncomeAccount::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense_account = IncomeAccount::find($id);
        $expense_account->name = $request->name;
        $expense_account->description = $request->description;
        $expense_account->save();
        return redirect()->route('income_account.index')->with(['status'=>'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
