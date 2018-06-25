<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      return view("expense.list")->with(['expense'=>Expense::all(),'title'=>'All the expenses']);
    }
}