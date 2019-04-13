@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>Edit Expense</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::model($expense,['files' => true,'method'=>'PATCH', 'action'=>['IncomeController@update',$expense->id]])}}


                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                    
                        <label>Transaction date</label>
                        <input type="date" name="date" value="{{$expense->date}}" class="form-control">

                        <label>Account</label>
                        <select class="form-control" name="expense_account_id">
                            <option></option>
                            @foreach($account as $accounts)
                             <option value="{{$accounts->id}}">{{$accounts->name}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label>Voucher number</label>
                        <input type="text" name="voucher_number" value="{{$expense->voucher_number}}" class="form-control">

                        <label>Particular</label>
                        <input type="text" name="particular" value="{{$expense->particular}}" class="form-control">

                    </div>

                    <div class="col-md-6 col-lg-6">
 
                        <label>Amount</label>
                        <input type="text" name="amount" value="{{$expense->amount}}" step="any" class="form-control number">

                        <label>Balance</label>
                        <input type="text" name="balance" value="{{$expense->balance}}" step="any" class="form-control number">                      

                        <label>Person name</label>
                        <input type="text" name="person_name" value="{{$expense->person_name}}" class="form-control">

                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="{{$expense->phone_number}}" step="any" class="form-control">
                    </div>
                </div>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    {{Form::close()}}                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection