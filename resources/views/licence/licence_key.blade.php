<html>
    <head>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>

    <body>        
   
        <div class="container">

            <h2>System license activation</h2>
            <hr>   
            <div class="card">
                <div class="card-body">   
                    @if (isset($status))
                        <div class="alert alert-danger" role="alert">
                            {{ $status }}
                        </div>
                    @endif 
                    
                    <hr>

                    <form action="{{url('activate_licence')}}" method="POST">
                        @csrf
                        <label for="licence_key">Enter Licence Key</label>
                        <input type="text" name="licence_key" class="form-control">

                        <hr>
                        <button class="btn btn-success" type="submit">Activate</button>
                    </form>

                    <?php $key = App\User::key()?>

                    <hr>
                    <a href="https://licence.agent.co.ug/licence/{!! $key !!}">Get new Licence key</a>
                </div>
            </div>
        </div>

</body>
</html>

