@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">    
                <div class="card-body">
                   <h1>{{$title}}</h1>     

                   <a href="/import_customer">Import excel sheet OR </a>   
                   <a href="{{route('customer.create')}}">Add one at a time</a>   
                   <br>
            
                    <table class="table table-hover table-striped" id="example">
                      <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Room Number</th>
                        <th>Room status</th>
                        <th>Semester</th>
                        <th>Photo</th>
                        <th>Action</th>                      
                      </thead>

                      <tbody>
                        @foreach($customers as $customer)
                          <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone_number}}</td>
                            <td>{{$customer->room_number}}</td>
                            <td>{{$customer->room_status}}</td>
                            <td>{{$customer->semester}}</td>
                            <td><img src="{{asset('pictures')}}/{{$customer->image_url}}" width="200px" height="250px"></td>
                            <td>

                              <form method="POST" action="{{route('customer.destroy',$customer->id)}}">
                                @csrf
                                {{method_field("DELETE")}}
                                <a href="{{route('customer.edit',$customer->id)}}">Edit</a>
                                <button type="submit">Delete</button>
                              </form>                              

                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{$customers->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>

                        
                    
@endsection

@include("layouts.data_tables")