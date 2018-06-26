@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>Add Expense</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('expense.store')}}">
                        @csrf
                        <label>Transaction date</label>
                        <input type="date" name="date" class="form-control">

                        <label>Voucher number</label>
                        <input type="text" name="voucher_number" class="form-control">

                        <label>Amount</label>
                        <input type="number" name="amount" step="any" class="form-control">

                        <label>Particular</label>
                        <textarea class="form-control" name="particular"></textarea>

                        <label>Account</label>
                        <select class="form-control" name="expense_account_id">
                            @foreach($account as $accounts)
                             <option value="{{$accounts->id}}">{{$accounts->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection