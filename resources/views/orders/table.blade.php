<style type="text/css">
    th{
        text-align: center;
    }
</style>

<div class="table-responsive">
    <table class="table" id="orders-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Creation Date</th>
                <th>Delivery Address</th>
                <th>Order ID</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
            <td>{!! $order->creation_date !!}</td>
            <td>{!! $order->delivery_address !!}</td>
                <td>{!! $order->order_id !!}</td>
                <td>{!! $order->total !!}</td>
                
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
