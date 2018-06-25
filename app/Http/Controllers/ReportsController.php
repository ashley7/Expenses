<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;

class ReportsController extends Controller
{
  
    public function index()
    {
   
    }

    public function create()
    {
        return view("reports");
    }

    public function store(Request $request)
    {
        $reportrange=explode("-", $request->reportrange);
        $from=$reportrange[0];

        $reformed_date = explode("/",$from);
        $new_date = $reformed_date[1]."-".$reformed_date[0]."-".$reformed_date[2];

        $to=$reportrange[1];

        $reformedto_date = explode("/",$to);
        $new_to_date = $reformedto_date[1]."-".$reformedto_date[0]."-".$reformedto_date[2];
         
        $from_date = date_create($new_date);
        $from = date_timestamp_get($from_date);

        $to_date = date_create($to);
        $to = date_timestamp_get($to_date);

        $title="Expenses From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("expense.list")->with(['expense'=>Expense::whereBetween('date', [$from,$to])->get(),'title'=>$title]);  
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
