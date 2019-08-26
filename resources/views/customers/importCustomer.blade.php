@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">               

                <div class="card-body">
                    <h1>Import customer</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/import_customer" enctype="multipart/form-data">

                        @csrf
                        <label>Excel file</label>
                        <input type="file" name="excel_file">
                        <br><br>
                       <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
