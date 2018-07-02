<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankDeposit;
use App\Bank;

class BankDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("bank.deposits")->with(["deposits"=>BankDeposit::all(),'banks'=>Bank::all(),'title'=>'List of All Banks Deposits']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("bank.add_deposite");
    }


    public function store(Request $request)
    {
        $this->validate($request,["bank_id"=>"required","amount"=>"required","date"=>"required","deposited_by"=>"required"]);

        $save_bankdeposit = new BankDeposit($request->all());
        $save_bankdeposit->user_id=\Auth::user()->id;
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_bankdeposit->date=date_timestamp_get($to_date);
        try {
            $save_bankdeposit->save();
            $status="Operation successful.";
             return redirect("bank_deposite")->with(["status"=>$status]);
        } catch (\Exception $e) {
            $status=$e->getMessage();
             return back()->with(["status"=>$status]);

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            BankDeposit::destroy($id);
        } catch (\Exception $e) {
            
        }

        return back()->with(["status"=>"Operation successfull"]);
    }
}
