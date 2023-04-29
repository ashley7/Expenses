@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>Add User</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('user.store')}}">
                        @csrf                         

                        <label>Person name</label>
                        <input type="text" name="name" class="form-control">

                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control">

                        <label for="user_type">User type</label>
                        <select name="user_type" id="user_type" class="form-control">
                            @foreach($user_types as $user_type)
                            <option value="{{$user_type}}">{{$user_type}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection