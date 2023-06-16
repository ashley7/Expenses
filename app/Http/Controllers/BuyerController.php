<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Sale;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Buyer::get();

        $data = [
            'customers'=>$customers,
            'title'=>'Customers'
        ];

        return view('sales.buyers')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'=>'Create new customer',

        ];

        return view('buyers.create_buyer')->with($data);
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
            'name'=>'required',
            'phone_number'=>'required'
        ];

        $this->validate($request,$rules);

        $saveBuyer = new Buyer();

        $saveBuyer->name = $request->name;

        $saveBuyer->phone_number = $request->phone_number;

        $saveBuyer->save();

        return redirect()->route('sales.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show($buyer_id)
    {
        $sales = Sale::where('buyer_id',$buyer_id)->paginate(100);

        $customer = Buyer::find($buyer_id);

        $buyers = Buyer::get();

        $payment_types = ['cash','mobile_money','card','bank'];

        $data = [
            'sales'=>$sales,
            'title'=>'Sales by '.$customer->name,
            'buyers'=>$buyers,
            'payment_types'=>$payment_types,
        ];

        return view('sales.sales')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
