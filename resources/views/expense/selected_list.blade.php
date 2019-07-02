@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">    
            <style type="text/css">
              .right{
                float: right;
              }
            </style>     

                <div class="card-body">
                  <a class="btn btn-primary right" href="{{route('expense.create')}}">Add Expense</a>
                  <h1>{{$title}}</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php $total=0; ?>
                    <table class="table table-hover table-striped" id="example">
                      <thead>
                        <th>Transaction date</th> <th>Voucher number</th> <th>Particular</th> <th>Expense account</th> <th>Name</th> <th>Phone</th> <th>Amount</th>
                      </thead>

                      <tbody>
                        @foreach($expense as $account)
                          <tr>
                              <td>{{date('d M Y',$account->date)}}</td>
                              <td>{{$account->voucher_number}}</td>
                              <td>{{$account->particular}}</td>
                              <td>{{$account->expenseaccount->name}}</td>
                              <td>{{$account->person_name}}</td>
                              <td>{{$account->phone_number}}</td>
                              <td>{{number_format($account->amount)}}</td>

                              <?php $total=$total+$account->amount; ?>
                          </tr>
                        @endforeach
                        <tr>
                            <th>Total</th> <th></th> <th></th> <th></th> <th></th> <th></th> <th><?php echo number_format($total) ?></th>
                        </tr>
                      </tbody>
                    </table>          
                 </div>
               </div>
             </div>
           </div>
         </div>
        @endsection

     @include("layouts.data_tables")