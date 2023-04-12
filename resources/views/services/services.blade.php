@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$title}}</h1>
    <a class="btn btn-primary" href="{{route('services.create')}}">Add Service</a>
    <hr>
 
    <div class="card">    
        <div class="card-body">
            <table class="table table-hover table-striped" id="expenses_table">
                <thead>
                    <th>Name</th> <th>Price</th> <th>Income</th> <th>Action</th>
                </thead>

                <tbody>

                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->name}}</td>
                        <td>{{$service->price}}</td>
                        <td>{{$service->income_account->name}}</td>
                        <td>
                        <a href="{{route('services.edit',$service->id)}}">Edit</a>
                        </td>
                        
                        </tr>
                    @endforeach
                                        
                </tbody>                      
            </table>
            </div>
        </div>
    </div>
    
            

@endsection

@include("layouts.data_tables")