@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Add Bank Deposit</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('bank_deposite.store')}}">
                        @csrf           
                        <label>Amount</label>
                        <input type="number" name="amount" step="any" class="form-control">
                        <label>Choose Bank</label>
                        <select class="form-control" name="bank_id">
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
                            @endforeach
                        </select>

                        <label>Deposited by</label>
                        <select class="form-control" name="deposited_by">
                            @foreach(App\User::all() as $users)
                              <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>

                        <label>Date of Deposit</label>
                        <input type="date" name="date" class="form-control">
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection