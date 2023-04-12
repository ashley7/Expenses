@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{$title}}</h3>
    <hr>
    <div class="row">

        <div class="col-md-3 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Todays Sales</h5>
                    {{$sales->count()}}                    
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div class="card">                

                <div class="card-body">
                    <h5>Amount sold</h5>
                    UGX {{number_format($amountSold)}}                 
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div class="card">
                <div class="card-body">
                <h5>Customers</h5>
                    {{$buyers}}                    
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div class="card">
                <div class="card-body">
                <h5>Pending payments</h5>
                    {{$balance}}                    
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
    <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Today's sales</h5>

                    @include('sales.master') 

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include("layouts.data_tables")
