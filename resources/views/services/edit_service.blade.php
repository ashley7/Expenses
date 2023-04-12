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
                    <form action="{{route('services.update',$service->id)}}" method="POST">
                        @csrf 
                        {{method_field('PATCH')}}

                        <label for="name">Service Name</label>
                        <input type="text" value="{{$service->name}}" class="form-control" name="name">

                        <label for="price">Price</label>
                        <input type="number" value="{{$service->price}}" class="form-control" name="price">

                        <label for="income_accounts">Related income account</label>
                        <select name="income_account_id" id="income_accounts" class="form-control">
                            @foreach($income_accounts as $income_account)
                                <option value="{{$income_account->id}}" {!! $income_account->id==$service->incomeaccount_id?"selected":""!!})>{{$income_account->name}}</option>
                            @endforeach
                        </select>

                        <hr>

                        <button type="submit" class="btn btn primary">Save changes</button>

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