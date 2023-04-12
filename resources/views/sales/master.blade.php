<?php
$total_cost = $total_paid = $total_discount = $total_balance = 0;
?>
<table class="table" id="expenses_table">
    <thead>
        <th>Date</th>
        <th>Customer</th>
        <th>Amount billed</th>
        <th>Amount paid</th>
        <th>Discount</th>
        <th>Balance</th>
        <th>By</th>
        <th>Action</th>
    </thead>

    <tbody>
        @foreach($sales as $sale) 
        <?php
        $cost=$sale->cost($sale->id);

        $total_cost=$total_cost+$cost;

        $paid = $sale->paid($sale->id);

        $total_paid = $total_paid +$paid;

        $discount = $sale->discounts($sale->id);

        $total_discount = $total_discount +  $discount;

        $balance = $sale->balance($sale->id);

        $total_balance=$total_balance+$balance;
        ?>               
            <tr>
                <td>{{$sale->created_at}}</td>
                <td>{{$sale->buyer->name}} <br> {{$sale->buyer->phone_number}}</td>
                <td>{{number_format($cost)}}</td>
                <td>{{number_format($paid)}}</td>
                <td>{{number_format($discount)}}</td>
                <td>{{number_format($balance)}}</td>
                <td>{{$sale->user->name}}</td>
                <td> 
                    <a href="{{route('sales.show',$sale->id)}}">Details</a>
                </td>
            </tr>
        @endforeach
    </tbody>

    <thead>
        <th>Total</th>
        <th></th>
        <th>{{number_format($total_cost)}}</th>
        <th>{{number_format($total_paid)}}</th>
        <th>{{number_format($total_discount)}}</th>
        <th>{{number_format($total_balance)}}</th>
        <th></th>
        <th></th>
    </thead>
</table>

<?php

try {
    ?>

    {{$sales->links()}}

    <?php
} catch (\Throwable $th) {
    //throw $th;
}

?>