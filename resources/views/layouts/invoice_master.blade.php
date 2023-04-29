<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title>{{$title}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Thembo Charles" name="Developer name" />
        <meta content="ashley7520charles@gmail.com" name="Developer email" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <style>
            th,td {
                background-color: #ffffff;
                border-style: none;
                border-width: 1px;
                text-align: center;
            }

            .bordered td {
                border-style: solid;
                border-width: 1px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

         

            .badge .badge-primary{
                background-color: #38c172 !important;
            }

            
            @media print{
                .hide_button{
                    display:none;
                }
            }

            .column, .col-md-4{
              float: left;
              width: 33.3333333333%;
            }

            .column_two{

                float: left;
                width: 50%;

            }

           @media screen and (max-width: 600px) {
              .column, .col-md-4{
                width: 100%;
              }
            }

            .column,.col-md-4 {
              flex: 33.3333333333%;
            }
            
        </style>
    </head>
    <body>
        @yield("content")
    </body>
</html>
