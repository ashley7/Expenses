@extends('layouts.app')

@section('content')
<div class="container">   
    <a href="{{route('buyer.create')}}"  class="btn btn-success">Add customers</a>
<hr>

    <div class="card">
        <div class="card-body"> 

        <table class="table">
            <thead>
                <th>Name</th>
                <th>Phone Number</th>
            </thead>

            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>
                        <a href="{{route('buyer.show',$customer->id)}}">
                        {{$customer->name}}
                        </a>
                    </td>
                    <td>{{$customer->phone_number}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
                      
        </div>
    </div>
</div> 

 

@endsection
@include("layouts.data_tables")