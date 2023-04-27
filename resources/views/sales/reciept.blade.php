@extends('layouts.app')

@section('content')
<div class="container">  
    
<a href="#" id="hide_form"  class="btn btn-success">Print</a> 
<br><br>
 

    <div class="card">
        <div class="card-body">   

        <div class="row"> 
              <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                  <center>
                    <img src="{{asset('images/logo.png')}}" width="100%">
                  </center>              
                 
                  
               </div>

               <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">
                <center>
                    <span style="text-transform: uppercase;"><strong>Lloli fun park</strong></span><br>
                    <span>Akamwesi mall, Kampala</span><br>
                    <span>+256 756 711 418</span>  <br>
                </center>
                  
              </div>              

               <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                            
                </div>
          </div>    

          <hr style="height:3px; border:none;color:green;background-color:blue;">

          <div class="row"> 
              <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">

                @if(!empty($sale->buyer_id))  
                  <p>TO: </p>               
                  <span>{{$sale->buyer->name}}</span><br>
                  <span>{{$sale->buyer->phone_number}} </span><br>
                  <span>{{$sale->buyer->address}}</span><br>
                @endif 

              </div>

              <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                <center>
                        <h3 contenteditable="true"><u>SALES RECIEPT</u></h3>
                </center>         
                </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">

               <strong>
                    <span class="text-danger">No. {{$sale->id}}</span><br>
                    <span>{{Carbon\Carbon::parse($sale->created_at )->format("d M Y")}}</span>
                 
                </strong>

            </div>
          </div>
          

            
         

            <table class="table">
                <thead>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Discount</th>
                    <th>Amount</th>
                 
                </thead>

                <tbody>
                    @foreach($sale->details as $detail)                
                        <tr>
                            <td>{{$detail->service->name}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>{{number_format($detail->amount)}}</td>
                            <td>{{number_format($detail->discount)}}</td>
                            <td>{{number_format($detail->amount)}}</td>
                          
                        </tr>

                        
                    @endforeach
                </tbody>
            </table>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h4>Payments</h4>
                    <table class="table">
                        @foreach($sale->payments as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>{{number_format($payment->amount)}}</td>
                                <td>{{$payment->user->name}}</td>
                            </tr>                        
                        @endforeach
                    </table>
                </div>

                <div class="col-md-6">
                    <hr>
                 
                    <table class="table">
                       
                        <tr>
                            <td>Total cost</td> <td>{{number_format($sale->cost($sale->id))}}</td>
                        </tr>                       

                        <tr>
                            <td>Paid</td> <td>{{number_format($sale->paid($sale->id))}}</td>
                        </tr> 

                        <tr>
                            <td>Balance</td> <td>UGX {{number_format($sale->balance($sale->id))}}</td>
                        </tr> 
                      
                    </table>
                    
                </div>
            </div>

            <p>Notes</p>
            @foreach($sale->comments as $comment)
              <p>{{$comment->comment}}</p>                          
            @endforeach

            <hr>
            <p>Processed by:  {{$sale->user->name}}</p>
            <p>Document printing time: {{now()}}</p>
            <p>Thank you.</p>

        </div>
    </div>
</div> 
@endsection
@push('scripts')
<script>
    $("#hide_form").click(function(){
        $("#hide_form").hide()      
        window.print();
        $("#hide_form").show()
    });
  </script>
@endpush
