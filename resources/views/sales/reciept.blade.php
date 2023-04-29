@extends('layouts.invoice_master')

@section('content')  

<strong>
    <a href="{{route('sales.index')}}" id="hide_form"  class="btn btn-success">Back</a> 
    <center>
        <img src="{{asset('images/logo.png')}}" width="100px">
    </center>

    <center>
        <span style="text-transform: uppercase;"><strong>LLOLI FUN PARK</strong></span><br>
        <span>Dealers in: Swimming pool|playground|Gardens|Restaurant</span><hr>
        <span>Akamwesi Mall</span><br>
        <span>Gayaza Road,Kyebando</span><br>
        <span>P.O.Box 26811,Kampala (U)</span><br>
        <span>+256784918758/+256756711418</span>  <br>
    </center>  
    <br>            
            
    <center>
        <span style="font-size: 12px;"><strong><u>RECIEPT</u></strong></span>
    </center>      
    @if(!empty($sale->buyer_id))  
        <span>TO: </span><br>               
        <span>{{$sale->buyer->name}}</span><br>
        <span>Tel:{{$sale->buyer->phone_number}} </span><br>
        <span>{{$sale->buyer->address}}</span><br>
    @endif
  
    <span class="text-danger">No. {{$sale->id}}</span><br>
    <span>{{Carbon\Carbon::parse($sale->created_at )->format("d M Y")}}</span>
    <hr>
        
    <table class="table">
        <thead>
            <th>Service</th>
            <th>Quantity</th>
            <th>Amount</th>
        </thead>
        <tbody>
            @foreach($sale->details as $detail)                
                <tr>
                    <td>{{$detail->service->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td>{{number_format($detail->amount)}}</td>                    
                </tr>                       
            @endforeach
        </tbody>
    </table> 

    <br>
    
    <span>Total cost: UGX {{number_format($sale->cost($sale->id))}}</span><br>
    <span>Paid amount: UGX {{number_format($sale->paid($sale->id))}}</span><br>
    <span>Balance: UGX {{number_format($sale->balance($sale->id))}}</span>
    <br>
    <span>Prices are inclussive of VAT</span><br>

    <span>Notes</span> <br>
    @foreach($sale->comments as $comment)
        <span>{{$comment->comment}}</span>                          
    @endforeach
    <hr>
    <span>Processed by:  {{$sale->user->name}}</span><br>
    <span>Date: {{now()->format('d M, Y: h i s')}}</span><br>
    <span>Thank you.</span> 
</strong>