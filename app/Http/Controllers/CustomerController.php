<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $customers = Customer::paginate(100);

        $data = [

            'title'=>'List of customers',
            'customers'=>$customers

        ];

        return view('customers.list')->with($data);
         


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $readCustomer = new Customer();

        $readCustomer->name = $request->name;

        $readCustomer->phone_number = $request->phone_number;

        $readCustomer->room_status = $request->room_status;

        $readCustomer->room_number = $request->room_number;

        $readCustomer->semester = $request->semester;


         if (!empty($request->file('photo'))) {

            $destinationPath = public_path('pictures');        

            $file = $request->file('photo');
            
            $file_name ='akamwese_file_'.time().$file->getClientOriginalName();

            $file->move($destinationPath, str_replace(" ", "_",$file_name) );

            $readCustomer->image_url = str_replace(" ", "_",$file_name);

    }

    $readCustomer->save();

    return redirect()->route('customer.index');

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {

        $readCustomer = Customer::find($customer);

        $data = [

            'title'=>'List of customers',
            
            'customers'=>$readCustomer

        ];

        return view('customers.edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {

        $readCustomer = Customer::find($customer);

        $readCustomer->name = $request->name;

        $readCustomer->phone_number = $request->phone_number;

        if (!empty($request->room_status)) {
            $readCustomer->room_status = $request->room_status;
        }       

        $readCustomer->room_number = $request->room_number;

        $readCustomer->semester = $request->semester;


         if (!empty($request->file('photo'))) {

            $destinationPath = public_path('pictures');

            try {

                unlink($destinationPath.'/'.$readCustomer->image_url);
                
            } catch (\Exception $e) {}

            $file = $request->file('photo');
            
            $file_name ='akamwese_file_'.time().$file->getClientOriginalName();

            $file->move($destinationPath, str_replace(" ", "_",$file_name) );

            $readCustomer->image_url = str_replace(" ", "_",$file_name);


        }

        $readCustomer->save();

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {

        $readCustomer = Customer::find($customer);

        $destinationPath = public_path('pictures');

        try {

            unlink($destinationPath.'/'.$readCustomer->image_url);
            
        } catch (\Exception $e) {}

        Customer::destroy($customer);

        return back();
        
    }


    public function importCustomers(Request $request)
    {

        $this->validate($request,['excel_file'=>'required']);                 

        \Excel::load($request->file('excel_file'), function($reader) {

            global $request;

            $dataresults = $reader->all();

            foreach ($dataresults as $clientData) {


                $save_Client = new Customer();

                $save_Client->name = $clientData->name;

                $save_Client->phone_number = $clientData->phone_number;

                $save_Client->room_number = $clientData->room_number;

                $save_Client->room_status = $clientData->room_status;

                $save_Client->semester = $clientData->semester;
                try {
                    $save_Client->save();
                } catch (\Exception $e) {}
            }

        });

        return redirect()->route('customer.index');
    }

    public function importCustomer()
    {
         return view('customers.importCustomer');
    }
}
