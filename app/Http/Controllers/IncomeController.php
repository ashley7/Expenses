<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomeAccount;
use App\Income;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'income'=>Income::orderBy('date','asc')->get(),
            'title'=>'All the Incomes',
            'accounts'=>IncomeAccount::all(),
            'account_title'=>'Income Account summery'
        ];

        return view("income.incomes")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("income.add_income")->with(['account'=>IncomeAccount::orderBy('name','ASC')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,["date"=>"required","voucher_number"=>"required","amount"=>"required","incomeaccount_id"=>"required"]);
        
        $save_expense = new Income($request->all());
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_expense->date=date_timestamp_get($to_date);
        $save_expense->amount=(double)str_replace(",", "", $request->amount);
        $save_expense->balance=(double)str_replace(",", "", $request->balance);
        try {
             $save_expense->save();
             echo "Saved";
        } catch (\Exception $e) {
             echo $e->getMessage();
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
         return view("income.edit_record")->with(["expense"=>Income::find($id),"account"=>IncomeAccount::orderBy('name','ASC')->get()]);
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
        $save_expense = Income::find($id);
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
        
        if (!empty($request->balance)) {
          $save_expense->balance = (double)str_replace(",", "", $request->balance);
       }

       if (!empty($request->particular)) {
           $save_expense->particular = $request->particular;
       }

       if (!empty($request->expense_account_id)) {
           $save_expense->incomeaccount_id=$request->expense_account_id;
       }
        
        try {
             $save_expense->save();
        } catch (\Exception $e) {}
        return redirect("income");
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
            Income::destroy($id);
        } catch (\Exception $e) {
            
        }

        return back()->with(["status"=>"Operation successfull"]);
    }

    public function income_report()
    {
        return view('income.income_report');
    }

    public function incomereport($id)
    {
        $data=explode("_", $id);
        $account=IncomeAccount::find($data[0]);
        $title="All Incpmes in ".$account->name." From: ".date("d M Y",$data[1])." To: ".date("d M Y",$data[2]);;
        return view("income.selected_list")->with(['expense'=>Income::whereBetween('date', [$data[1],$data[2]])->where('incomeaccount_id',$id)->get(),'title'=>$title]);
    }

    public function report(Request $request)
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

        $title="Income From: ".date("d M Y",$from)." To: ".date("d M Y",$to);

        return view("income.incomes")->with(['income'=>Income::whereBetween('date', [$from,$to])->get(),'title'=>$title,'accounts'=>IncomeAccount::all(),'from'=>$from,'to'=>$to]);
    }


    public function search_income_record(Request $request)
    {

        $search_text = $request->search_text;

        if(empty($search_text)) return back();

        $incomes = Income::where('voucher_number','LIKE','%'.$search_text.'%')
        ->orWhere('phone_number','LIKE','%'.$search_text.'%') 
        ->orWhere('person_name','LIKE','%'.$search_text.'%') 
        ->orWhere('particular','LIKE','%'.$search_text.'%') 
        ->orWhere('id','LIKE','%'.$search_text.'%') 
        ->orderBy('date','asc')->paginate(100);

        $income_account = IncomeAccount::get();

        $total = $incomes->sum('amount');

        $data = [
            'income'=>$incomes,
            'title'=>'All the Incomes',
            'accounts'=> $income_account,
            'account_title'=>'Income Account summery',
            'total' => $total
        ];

        return view("income.incomes")->with($data);
        
    }
    
}
