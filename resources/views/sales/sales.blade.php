@extends('layouts.app')

@section('content')
<div class="container">   

<h4>{{$title}}</h4>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_sale">
  Add new sale
</button>

<a href="{{route('sales.create')}}"  class="btn btn-success">Sales Report</a>
<hr>

    <div class="card">
        <div class="card-body"> 
            @include('sales.master')           
        </div>
    </div>
</div> 

 
<div class="modal" id="add_sale">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add new sale</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

            <form action="{{route('sales.store')}}" method="POST">
                @csrf 

                <label for="sale_date">Date</label>                        
                <input type="date" class="form-control" required name="sale_date" value="{{date('Y-m-d')}}">

                <label for="income_accounts">Customer</label>
                <select name="buyer_id" id="buyer_id" class="form-control" required>
                    @foreach($buyers as $buyer)
                        <option value="{{$buyer->id}}">{{$buyer->name}}</option>
                    @endforeach
                </select>

                <label for="payment_type">Payment type</label>
                <select name="payment_type" id="payment_type" class="form-control">
                    @foreach($payment_types as $payment_type)
                     <option value="{{$payment_type}}">{{$payment_type}}</option>
                    @endforeach
                </select>

                <hr>

                <a href="{{route('buyer.create')}}">Create customer</a><br>

                <button type="submit" class="btn btn-primary">Save</button>

            </form>   

         
            
        </div>    
    </div>
  </div>
</div>

@endsection
@include("layouts.data_tables")