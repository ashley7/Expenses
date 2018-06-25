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
                    <h1>List of Expense account</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-striped" id="example">
                        <thead>
                            <th>Name</th> <th>Description</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                              <tr>
                                  <td>{{$account->name}}</td>
                                  <td>{{$account->description}}</td>
                                  <td><a class="btn btn-primary" href="{{route('account.show',$account->id)}}">Show expenses</a></td>
                              </tr>
                            @endforeach                            
                        </tbody>                      
                    </table>               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')  
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>  -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
     <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    { extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>

@endpush