<li class="{{ Route::is('orders.index') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-id-card-o"></i><span>Orders</span></a>
</li>

<li class="{{ Route::is('orders.list') ? 'active' : '' }}">
    <a href="{!! route('orders.list') !!}"><i class="fa fa-user-circle"></i><span>Order List</span></a>
</li>

