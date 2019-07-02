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
                     <a class="btn btn-primary" href="{{route('user.create')}}">Add User</a>
                  </span>
                 

                  <h1>Users</h1>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

              

                <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                            <th>#</th> <th>Name</th> <th>Phone</th>
                        </thead>

                        <tbody>

                          @foreach($user as $users)
                            <tr>
                              <td>{{$users->id}}</td>
                              <td>{{$users->name}}</td>
                              <td>{{$users->phone_number}}</td>
                              
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