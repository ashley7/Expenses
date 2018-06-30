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
                  <a href="/bankreport" class="btn btn-primary left">Generate Report</a>
                  <a class="btn btn-primary right" href="{{route('bank_deposite.create')}}">Add bank Deposit</a>
                  <h1>{{$title}}</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php $total = 0; ?>
                 <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                            <th>Date</th>  <th>Deposited by</th> <th>Bank</th> <th>Amount</th> <th>Recorded by</th>
                        </thead>

                        <tbody>
                          @foreach($deposits as $deposit)
                            <tr>
                              <td>{{date('d-m-Y',$deposit->date)}}</td>
                              <td>{{App\User::find($deposit->deposited_by)->name}}</td>
                              <td>{{$deposit->bank->name}}</td>
                              <td>{{number_format($deposit->amount)}}</td>
                               <td>{{$deposit->user->name}}</td>
                            </tr>
                            <?php $total = $total +  $deposit->amount;?>
                          @endforeach
                          <tr>
                             <th>Total</th>  <th></th> <th></th> <th>{{number_format($total)}}</th> <th></th>
                          </tr>                                                
                        </tbody>                      
                    </table>
                  </div>

                   <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="example">
                        <thead>
                            <th>Bank name</th>  <th>Total</th> 
                            @if(!empty($from))
                              <th></th>
                            @endif
                        </thead>               


                        <tbody>
                          @foreach($banks as $bank)
                            <tr>
                              <td>{{$bank->name}}</td>
                              @if(empty($from))
                                  <td>{{number_format(App\BankDeposit::all()->where('bank_id',$bank->id)->sum('amount'))}}</td>
                                @else
                                  <td>{{number_format(App\BankDeposit::where('bank_id',$bank->id)->whereBetween('date', [$from,$to])->sum('amount'))}}</td>

                                  <?php $id=$bank->id."_".$from."_".$to?>

                                  <td><a href="{{route('bank.edit',$id)}}">Show Details</a></td>
                                @endif

                            </tr>
                            
                          @endforeach
                                                                       
                        </tbody>                      
                    </table>
                  </div>




                </div>
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
            $('#example').append('<caption style="caption-side: bottom">Powered by Appcellon ltd.</caption>');
         
            $('#example,#expenses_table').DataTable( {
                dom: 'Bfrtip',

                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        messageTop: ''
                    },
                    {
                        extend: 'pdf',
                        messageTop: ''
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