@extends('layouts.app')

@section('content')
<div class="container">
  <h5>{{$title}}</h5> 
  <a class="btn btn-primary" href="/income_report">Generate Report</a> 
  <a class="btn btn-primary " href="{{route('income.create')}}">Add Income</a>
  <a class="btn btn-primary " href="{{route('income_account.index')}}">Income Account</a>
  <hr>
  <div class="card">
    <div class="card-body">
      <form method="POST" action="/search_income_record" class="col-md-8">
        @csrf 
        <input type="text" style="width: 80%;" placeholder="Search manually" name="search_text">
        <button class="badge badge-success p-1" type="submit">Search</button>
      </form>
      <hr>

   
      <?php $total=0; ?>                    
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="example">
            <thead>
              <th>#</th>
              <th>Transaction date</th>
              <th>Voucher number</th>
              <th>Particular</th>
              <th>Income Account</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Amount</th>
              <th>Balance</th>
              <th>Actions</th>
            </thead>

                      <tbody>
                        @foreach($income as $account)
                          <tr>
                              <td>{{$account->id}}</td>
                              <td>{{date('Y-m-d',$account->date)}}</td>
                              <td>{{$account->voucher_number}}</td>
                              <td>{{$account->particular}}</td>
                              <td>{{$account->incomeaccount->name}}</td>
                              <td>{{$account->person_name}}</td>
                              <td>{{$account->phone_number}}</td>
                              <td>{{number_format($account->amount)}}</td>
                              <td>{{number_format($account->balance)}}</td>
                              <?php $total=$total+$account->amount; ?>
                              <td>

                                 <form action="{{route('income.destroy',$account->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?'); return false;">
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                    @if(Auth::user()->user_type == "administrator")
                                      <a href="{{route('income.edit',$account->id)}}" class="badge badge-primary">Edit</a>
                                      <button  class="badge badge-danger" type="submit">Delete</button>
                                    @endif
                                </form>
                              </td>
                          </tr>
                        @endforeach
                        <tr>
                            <th>Total</th> <th></th> <th></th> <th></th> <th></th><th></th> <th></th><th><?php echo number_format($total) ?></th> <th></th> <th></th>
                        </tr>
                      </tbody>
                    </table> 
                    <?php 
                    try {
                      
                      ?>
                    {{$income->links()}}
                      <?php
                    } catch (\Throwable $th) {
                      //throw $th;
                    }   
                    
                    ?>         
                 </div>
               </div>
              @if(empty($from))
                <?php  $total=0; ?>
                 
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                          <th>#</th>  <th>Name</th> <th>Description</th> <th>Total amounts</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                            <?php 
                             $accounts=App\Income::all()->where('incomeaccount_id',$account->id)->sum('amount');
                             $total=$total+ $accounts;                           

                             ?>
                              <tr>
                                  <td>{{$account->id}}</td>
                                  <td>{{$account->name}}</td>
                                  <td>{{$account->description}}</td>
                                  <td>{{number_format($accounts)}}</td>
                                  <td><a class="btn btn-success" href="{{route('income_account.show',$account->id)}}">Show</a>
                                  <a class="btn btn-primary" href="{{route('income_account.edit',$account->id)}}">Edit</a>

                                  </td>
                              </tr>
                            @endforeach 
                            <td>Total</td><td></td> <td></td> <td>{{number_format($total)}}</td> <td></td>                           
                        </tbody>                      
                    </table>
                  </div>
              @else

              <?php  $total=0 ?>

                <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                          <th>#</th>  <th>Name</th> <th>Description</th> <th>Total amounts</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                            <?php 
                             $accounts=App\Income::whereBetween('date', [$from,$to])->where('incomeaccount_id',$account->id)->sum('amount');
                             $total=$total+ $accounts;

                             $id=$account->id."_".$from."_".$to;                         

                             ?>
                              <tr>
                                  <td>{{$account->id}}</td>
                                  <td>{{$account->name}}</td>
                                  <td>{{$account->description}}</td>
                                  <td>{{number_format($accounts)}}</td>
                                  <td><a class="btn btn-primary" href="/income_report/{{$id}}">Show Incomes</a></td>
                              </tr>
                            @endforeach 
                            <td>Total</td> <td></td> <td></td> <td>{{number_format($total)}}</td> <td></td>                           
                        </tbody>                      
                    </table>
                  </div>

              @endif
         
              
            
@endsection

@include("layouts.data_tables")