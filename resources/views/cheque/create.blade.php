@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Add Cheque</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('cheque.store')}}">
                        @csrf           
                        <label>Cheque number</label>
                        <input type="text" name="cheque_number" class="form-control">
                        <br>
                        <label>Amount</label>
                        <input type="number" step="any" name="amount" class="form-control">
                        <br>
                        <label>Particular</label>
                        <input type="text" name="particular" class="form-control">
                        <br>
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                        <br>
                        <label>Choose Bank</label>
                        <select class="form-control" name="bank_id">
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
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