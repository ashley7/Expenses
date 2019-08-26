@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">               

                <div class="card-body">
                    <h1>Edit customer</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('customer.update',$customers->id)}}" enctype="multipart/form-data">

                        {{method_field('PATCH')}}
                        @csrf 

                        <label>Name</label>
                        <input type="text" value="{{$customers->name}}" name="name" class="form-control">
                        

                        <label>Phone number</label>
                        <input type="text" value="{{$customers->phone_number}}" name="phone_number" class="form-control">


                        <label>Room Number</label>
                        <input type="text" value="{{$customers->room_number}}" name="room_number" class="form-control">

                        <label>Room Status [{{$customers->room_status}}]</label>
                        <select name="room_status" class="form-control">
                            <option></option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                            <option value="Tripple">Tripple</option>
                        </select>
                        
                        <label>Semester</label>
                        <input type="text" placeholder="Sem-2 2019" value="{{$customers->semester}}" name="semester" class="form-control">

                        <label>Image</label><br>
                        <input type="file" name="photo" accept="image/*">
                        <br>
                        <img src="{{asset('pictures')}}/{{$customers->image_url}}" width="75px" height="100px"><br>
                       <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
