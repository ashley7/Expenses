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
                    <a class="btn btn-primary right" href="{{route('account.create')}}">Add account</a>
                    <h1>{{$expense_title}}</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php $total=0; ?>
                    <table class="table table-hover table-striped" id="example">
                        <thead>
                           <th>#</th> <th>Name</th> <th>Description</th> <th>Total amounts</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                            <?php 
                             $accounts=App\Expense::all()->where('expense_account_id',$account->id)->sum('amount');
                             $total=$total+ $accounts

                             ?>
                              <tr>
                                  <td>{{$account->id}}</td>
                                  <td>{{$account->name}}</td>
                                  <td>{{$account->description}}</td>
                                  <td>{{number_format($accounts)}}</td>
                                  <td>
                                    <a class="btn btn-success" href="{{route('account.show',$account->id)}}">Show</a>
                                    <a class="btn btn-primary" href="{{route('account.edit',$account->id)}}">Edit</a>
                                  </td>
                              </tr>
                            @endforeach 
                            <td>Total</td> <td></td> <td></td> <td>{{number_format($total)}}</td> <td></td>                           
                        </tbody>                      
                    </table>               
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection

@include("layouts.data_tables")

 