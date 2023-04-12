<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'amount'=>'required|numeric'
        ];

        $this->validate($request,$rules);

        $savePayment = new SalePayment();

        $savePayment->amount = $request->amount;

        $savePayment->sale_id = $request->sale_id;

        $savePayment->user_id = Auth::id();

        $savePayment->save();

        return redirect()->route('sales.show',$savePayment->sale_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id);

        $data = [
            'sale'=>$sale,
            'title'=>'Sales reciept'
        ];

        return view('sales.reciept')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SalePayment $salePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalePayment $salePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalePayment $salePayment)
    {
        //
    }
}
