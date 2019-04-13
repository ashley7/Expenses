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
                  <span class="right">
                    <a class="btn btn-primary" href="/income_report">Generate Report</a> 
                    <a class="btn btn-primary " href="{{route('income.create')}}">Add Income</a>
                    <a class="btn btn-primary " href="{{route('income_account.index')}}">Income Account</a>
                  </span>
                  <h5>{{$title}}</h5>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br><br>

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
                              <td>{{date('d M Y',$account->date)}}</td>
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
                                    <a href="{{route('income.edit',$account->id)}}" class="btn btn-info">Edit</a>
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                </form>
                              </td>
                          </tr>
                        @endforeach
                        <tr>
                            <th>Total</th> <th></th> <th></th> <th></th> <th></th><th></th> <th></th><th><?php echo number_format($total) ?></th> <th></th> <th></th>
                        </tr>
                      </tbody>
                    </table>          
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

@push('scripts')
     <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
     <script>
       $(document).ready(function() {
            var printCounter = 0;
         
            // Append a caption to the table before the DataTables initialisation
         
            $('#example,#expenses_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        messageTop: '{{$title}}'
                    },
                    {
                        extend: 'pdf',
                        messageTop: '{{$title}}'
                    },
                    {
                        extend: 'print',
                        messageTop: null
                    }
                ]
            } );
        } );
    </script>

@endpush