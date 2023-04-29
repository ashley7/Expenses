<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Sale;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::paginate(100);

        $buyers = Buyer::get();

        $payment_types = ['cash','mobile_money','card','bank'];

        $data = [
            'sales'=>$sales,
            'title'=>'Sales',
            'buyers'=>$buyers,
            'payment_types'=>$payment_types,
        ];

        return view('sales.sales')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();

        $data = [
            'title'=>'Sales report',
            'users'=>$users,
        ];

        return view('sales.sale_report')->with($data);
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
            'buyer_id'=>'required',
            'sale_date'=>'required',
        ];

        $this->validate($request,$rules);

        $saveSale = new Sale();

        $saveSale->buyer_id = $request->buyer_id;

        $saveSale->sale_date = $request->sale_date;

        $saveSale->user_id = Auth::id();

        $saveSale->payment_type = $request->payment_type;

        $saveSale->save();

        return redirect()->route('sales.show',$saveSale->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id);

        $services = Service::orderby('name','ASC')->get();

        $data = [
            'services'=>$services,
            'sale'=>$sale,
            'title'=>'Sale'
        ];

        return view('sales.details')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }


    public function sales_report(Request $request)
    {

        $rules = [
            'from'=>'required',
            'to'=>'required',
            'users'=>'required',
        ];

        $this->validate($request,$rules);

        $from = Carbon::createFromFormat("Y-m-d",$request->from)->subDay();

        $to = Carbon::createFromFormat("Y-m-d",$request->to)->addDay();

        $sales = Sale::whereBetween(DB::raw('DATE(created_at)'),[$from,$to])->whereIn('user_id',$request->users)->get();

        $buyers = Buyer::get();

        $payment_types = ['cash','mobile_money','card','bank'];

        $data = [
            'sales'=>$sales,
            'title'=>'Sales',
            'buyers'=>$buyers,
            'payment_types'=>$payment_types,
        ];

        return view('sales.sales')->with($data);
         
    }
}
