<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use App\ExpenseAccount;
use App\Expense;
use App\Sale;
use App\SalePayment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

      $buyers = Buyer::count();

      $sales = Sale::whereDate('created_at',today())->get();

      $amountSold = Sale::whereDate('sales.created_at',today())->join('sale_details','sales.id','sale_details.sale_id')->sum(DB::raw('quantity * amount - discount'));

      $allTimesSales = Sale::join('sale_details','sales.id','sale_details.sale_id')->sum(DB::raw('amount'));

      $payments = SalePayment::sum('amount');

      $balance = $allTimesSales-$payments;

      $data = [
        'buyers'=>$buyers,
        'sales'=>$sales,
        'amountSold'=>$amountSold,
        'title'=>'Dashboard',
        'balance'=>$balance,
      ];

      return view('home')->with($data);


    }
}