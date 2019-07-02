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
                  <a class="btn btn-primary right" href="{{route('bank.create')}}">Add bank</a>
                  <h1>List of Banks</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

              

                <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                            <th>Name</th> <th></th>
                        </thead>

                        <tbody>

                          @foreach($bank as $banks)
                            <tr>
                              <td>{{$banks->name}}</td>
                              <td><a class="btn btn-primary" href="{{route('bank.show',$banks->id)}}">Show Deposits</a></td>
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

@include("layouts.data_tables")