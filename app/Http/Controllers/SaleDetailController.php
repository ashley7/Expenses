<?php

namespace App\Http\Controllers;

use App\Income;
use App\Sale;
use App\SaleDetail;
use App\SalePayment;
use App\Service;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
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
            'service_id'=>'required',
            'quantity'=>'required|numeric'
        ];

        $this->validate($request,$rules);

        $service = Service::find($request->service_id);

        $total_paid=str_replace(",","",$request->total_paid);

        $discount = ($service->price*$request->quantity)-(double)$total_paid;

        $saveSaleDetail = new SaleDetail();

        $saveSaleDetail->sale_id = $request->sale_id;

        $saveSaleDetail->quantity = $request->quantity;

        $saveSaleDetail->discount = $discount;

        $saveSaleDetail->service_id = $service->id;

        $saveSaleDetail->amount = (double)$total_paid;

        $saveSaleDetail->save();

        if($request->paid == "paid")

            SalePayment::savePayment($saveSaleDetail->amount,$saveSaleDetail->sale_id);

        $amount = $saveSaleDetail->amount;

        $income = Income::saveIncome(now(),$saveSaleDetail->id,$amount,$service->incomeaccount_id,$service->name,$saveSaleDetail->sale->buyer->phone_number,$saveSaleDetail->sale->buyer->name);

        $income->sale_detail_id=$saveSaleDetail->id;

        $income->save();
        
        return  redirect()->route('sales.show',$saveSaleDetail->sale_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sale_detail_id)
    {
        $service = Service::find($request->service_id);

        $saveSaleDetail = SaleDetail::find($sale_detail_id);

        $saveSaleDetail->quantity = $request->quantity;

        $saveSaleDetail->discount = $request->discount;

        $saveSaleDetail->service_id = $service->id;

        $saveSaleDetail->amount = $service->price;

        $saveSaleDetail->save();

        $amount = $saveSaleDetail->amount-$saveSaleDetail->discount;
        
        $income = Income::where('sale_detail_id',$saveSaleDetail->id)->get();

        if($income->count() == 0)
        
            return  redirect()->route('sales.show',$saveSaleDetail->sale_id);

        $income = $income->last();

        $income->amount = $amount;

        $income->save();

        return  redirect()->route('sales.show',$saveSaleDetail->sale_id);       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleDetail $saleDetail)
    {
        Income::where('sale_detail_id',$saleDetail->id)->delete();

        SaleDetail::destroy($saleDetail->id);

        return  redirect()->route('sales.show',$saleDetail->sale_id);       

    }


    public function get_price(Request $var)
    {
        $service = Service::find($var->service_id);

        return $service->price*$var->quantity;
    }
}
