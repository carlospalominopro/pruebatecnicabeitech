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
                <th>Order ID</th>
                <th>Total</th>
                <th>Delivery Address</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
        @if (isset($orders))
            
            @foreach($orders as $order)
                <tr>
                <td>{!! $order->creation_date !!}</td>
                    <td>{!! $order->order_id !!}</td>
                    <td>{!! $order->total !!}</td>
                    <td>{!! $order->delivery_address !!}</td>

                    <td>

                    @if (isset($products))

                        @foreach ($products as $key => $value)

                            @if (isset($value[$order->order_id]))
                                
                                {{ $value[$order->order_id]['quantity'].' x '.$value[$order->order_id]['name']}}
                                <br>

                            @endif                            

                        @endforeach

                    @else

                        No products

                    @endif

                    </td>
                  
                </tr>
            @endforeach
            
        @endif
        </tbody>
    </table>
</div>
