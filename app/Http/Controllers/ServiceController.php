<?php

namespace App\Http\Controllers;

use App\IncomeAccount;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $services = Service::get();

        $data = [
            'services'=>$services,
            'title'=>'Service'
        ];

        return view('services.services')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $income_accounts = IncomeAccount::get();

        $data = [
            'title'=>'Create a service',
            'income_accounts'=>$income_accounts,
        ];

        return view('services.create_service')->with($data);
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
            'price'=>'required|numeric'
        ];

        $this->validate($request,$rules);

        $saveService = new Service();

        $saveService->name = $request->name;

        $saveService->price = $request->price;

        $saveService->incomeaccount_id = $request->income_account_id;

        $saveService->save();

        return redirect()->route('services.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        $service = Service::find($service_id);

        $income_accounts = IncomeAccount::get();

        $data = [
            'service'=>$service,
            'title'=>'Edit service',
            'income_accounts'=>$income_accounts
        ];

        return view('services.edit_service')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service_id)
    {
        $saveService = Service::find($service_id);

        $saveService->name = $request->name;

        $saveService->price = $request->price;

        $saveService->incomeaccount_id = $request->income_account_id;

        $saveService->save();

        return redirect()->route('services.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
