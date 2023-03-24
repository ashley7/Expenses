@extends('layouts.app')

@section('content')
<div class="container">

<h5>{{$title}}</h5>

<span class="right">
    <a class="btn btn-primary" href="/income_report">Generate Report</a> 
    <a class="btn btn-primary " href="{{route('income.create')}}">Add Income</a>
    <a class="btn btn-primary " href="{{route('income_account.index')}}">Income Account</a>
  </span>

  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  <hr>
  <form method="POST" action="/search_income_record" class="col-md-4">
    @csrf 
    <input type="text" style="width: 80%;" placeholder="Search manually" name="search_text">
    <button style="float: right;" class="badge badge-success p-2" type="submit">Search</button>
  </form>
  <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
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

                                 <form action="{{route('income.destroy',$account->id)}}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                    <a href="{{route('income.edit',$account->id)}}" class="text-info">Edit</a>
                                    <input type="submit" class="btn btn-danger" value="X"/>
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
                <div class="card-body">
                   <h1></h1>
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



            </div>
        </div>
    </div>
</div>
@endsection

@include("layouts.data_tables")