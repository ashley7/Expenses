@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="card">
        <div class="card-body">       
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <form action="{{route('buyer.store')}}" method="POST">
                        @csrf 

                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name">

                        <label for="price">Phone number</label>
                        <input type="text" class="form-control" name="phone_number">                     

                        <hr>

                        <button type="submit" class="btn btn primary">Save</button>

                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>         

@endsection

@include("layouts.data_tables")

@push('scripts')
<script>
    $("#income_account_id").chosen({
        width:"100%"
    });
</script>
@endpush