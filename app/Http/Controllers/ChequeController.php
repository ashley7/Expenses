<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cheque;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("cheque.list")->with(["cheques"=>Cheque::all(),'title'=>'List of cheque dispatch']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cheque.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_cheque=new Cheque($request->all());
        $save_cheque->user_id=\Auth::user()->id;
        $to_date = date_create(str_replace("/", "-", $request->date));
        $save_cheque->date=date_timestamp_get($to_date);
        $save_cheque->save();
        return back()->with(["status"=>"Cheque saved successfully."]);
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
            Cheque::destroy($id);
        } catch (\Exception $e) {
            
        }
        return back()->with(["status"=>"Operation successfull"]);
    }



    
}
