@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{$title}}</h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{url('sales_report')}}">
                        @csrf
                        <label>From</label>
                        <input type="date" name="from" class="form-control col-md-6">    
                        
                        <label>To</label>
                        <input type="date" name="to" class="form-control col-md-6"> 
                        
                        <label for="users">Sells made by</label>
                        <select name="users[]" id="users" multiple class="form-control col-md-6">
                            @foreach($users as $user)
                              <option selected value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        
                        <hr>
                        <button class="btn btn-primary" id="saveBtn" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#users").chosen({
        width:"100%"
    })
</script>
@endpush

 