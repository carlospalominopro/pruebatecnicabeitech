@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Orders</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('orders.create') !!}">Crear Orden</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('orders.table')
            </div>
        </div>
        <div class="text-center">
            
             {!! $orders->links('vendor.pagination.bootstrap-4') !!}

        </div>
    </div>
@endsection

