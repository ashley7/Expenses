<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "user"=>User::get(),
            "title"=>"List of users"
        ];
        return view("users.list")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = ['administrator','reception'];

        return view("users.create")->with(['user_types'=>$user_types]);
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
            'user_type'=>'required',
            'phone_number'=>'required'
        ];

        $this->validate($request,$rules);

        $save_user = new User();

        $save_user->name = $request->name;

        $save_user->user_type = $request->user_type;

        $save_user->phone_number=$request->phone_number;        
        
        $save_user->password = bcrypt("user123@");

        $save_user->save();

        return back()->with(['status'=>'User created']);

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

        $user = Auth::user();

        $data = [
            'title'=>'Change password',
            'user'=>$user,
        ];

        return view('users.change_password')->with($data);
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

        $rules = [
            'name'=>'required',
            'phone_number'=>'required',
            'password'=>'required|confirmed'
        ];

        $this->validate($request,$rules);

        $user = Auth::user();

        $user->name = $request->name;

        $user->phone_number = $request->phone_number;

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back();

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
            User::destroy($id);
        } catch (\Throwable $th) {}       

        return back();
    }

    public function activateLicence(Request $activate)
    {

        $rules = ['licence_key'=>'required'];

        $this->validate($activate,$rules);

        $path = User::getFile();

        $fp = fopen($path, "w");

        fwrite($fp, $activate->licence_key);
        
        return redirect('/');         
    }
}
