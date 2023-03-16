@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              
                <div class="card-body">

                    <h1>Edit profile</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('user.update',$user->id)}}">
                        @csrf                         

                        <label>Person name</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control">

                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="{{$user->phone_number}}" class="form-control">

                        <label>Password</label>
                        <input type="password" name="password" value="{{$user->password}}" class="form-control">

                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        <br>
                        <button class="btn btn-primary" type="submit">Save changes</button>

                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection