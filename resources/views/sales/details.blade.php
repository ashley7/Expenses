@extends('layouts.app')

@section('content')
<div class="container">   
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_item">
    Add service
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_payment">
    Add Payment
    </button>

    <a class="btn btn-success" href="{{route('sale_payments.show',$sale->id)}}">Print sales reciept</a>
    <hr>

    <div class="card">
        <div class="card-body">

            <div class="row"> 
              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                  <center>
                    <img src="{{asset('images/logo.png')}}" width="30%">
                  </center>
               </div>
              

              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12"> 
                
                <center>
                    <span style="text-transform: uppercase;"><strong>Lloli fun park</strong></span><br>
                    <span>Akamwesi mall, Kampala</span><br>
                    <span>+256 756 711 418</span>  <br> 
                </center>                   
                  
              </div>              

              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                @if(!empty($sale->buyer_id))   
                  <p>TO: </p>             
                  <span>Name: {{$sale->buyer->name}}</span><br>
                  <span>Phone: {{$sale->buyer->phone_number}}</span><br>
                @endif
                <p><strong>No. {{$sale->id}}</strong></p>
                   
              </div>
          </div>       


          
            <hr>
            <table class="table">
                <thead>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Discount</th>
                    <th>Amount</th>
                    <th>Action</th>
                </thead>

                <tbody>
                    @foreach($sale->details as $detail)                
                        <tr>
                            <td>{{$detail->service->name}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>{{number_format($detail->service->price*$detail->quantity)}}</td>
                            <td>{{number_format($detail->discount)}}</td>
                            <td>{{number_format($detail->amount)}}</td>
                            <td>
                                <form action="{{route('sale_details.destroy',$detail->id)}}" method="POST" onsubmit="return confirm('Do you want to delete this Item?'); return false;">
                                    @csrf 
                                    {{method_field('DELETE')}}
                                    <!-- <span data-toggle="modal" class="badge badge-primary p-1" data-target="#edit_item{{$detail->id}}">Update</span> -->
                                    <button type="submit" class="badge badge-danger">Delete</button>

                                </form>
                            </td>
                        </tr>

                        <div class="modal" id="edit_item{{$detail->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit {{$detail->service->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">

                                    <form action="{{route('sale_details.update',$detail->id)}}" method="POST">
                                        @csrf
                                        {{method_field('PATCH')}}

                                        <label for="service_id">Service ID</label>
                                        <select name="service_id" id="service_id" class="form-control">
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" {{$service->id==$detail->service_id?"selected":""}}>{{$service->name}} ({{number_format($service->price)}})</option>
                                            @endforeach
                                        </select>

                                        <label for="quantity">Quantity</label>
                                        <input type="number" step="any" value="{{$detail->quantity}}" class="form-control" name="quantity">

                                        <label for="discount">Total paid </label>
                                        <input type="number" class="form-control" value="" name="total_paid">


                                        <hr>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </form>
                                        
                                    </div>    
                                </div>
                            </div>
                        </div>
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

        </div>
    </div>
</div> 
 
<div class="modal" id="add_item">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Item</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

        <form action="{{route('sale_details.store')}}" method="POST">
            @csrf

            <label for="service_id">Select Service</label>
            <select name="service_id" id="service_id" class="form-control">
                <option value=""></option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{number_format($service->price)}})</option>
                @endforeach
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" step="any" class="form-control" name="quantity" id="quantity">

            <hr>

            <input type="radio" checked name="paid" value="paid"> Paid <br>
            <input type="radio" name="paid" value="notpaid">Not Paid<br>

            <label for="discount">Total paid </label>
            <input type="text" class="form-control total_paid" name="total_paid" id="total_paid">

            <input type="hidden" name="sale_id" value="{{$sale->id}}">

            <hr>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
            
        </div>    
    </div>
  </div>
</div>


 
<div class="modal" id="add_payment">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Payment</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

        <form action="{{route('sale_payments.store')}}" method="POST">
            @csrf             

            <label for="amount">Amount</label>
            <input type="number" step="any" class="form-control" name="amount" value="{{$sale->balance($sale->id)}}">             

            <input type="hidden" name="sale_id" value="{{$sale->id}}">

            <hr>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
            
        </div>    
    </div>
  </div>
</div>
@endsection

@push("scripts")
<script>

    var $input = $('#quantity');
    $input.on('keyup', function () {

        $.ajax({

            type: "POST",

            url: "{{url('/get_price')}}",

            data: {

                quantity: $("#quantity").val(),
                service_id:$("#service_id").val(),

            _token: "{{Session::token()}}"

            },
            success: function(result){               

                $('#total_paid').val(result);

            }

            });    
    });

    var elc = document.querySelector('input.total_paid');
    elc.addEventListener('keyup', function (event) {
      if (event.which >= 37 && event.which <= 40) return;
      this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    });

</script>
@endpush
