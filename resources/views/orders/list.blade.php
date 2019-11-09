@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="pull-left">Listado de Ordenes x Cliente</h1>
        <br>       
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
                {!! Form::open(['route' => 'orders.list', 'id'=>'form_list', 'method'=>'GET']) !!}

                    <!-- Search form -->
                    <div class="md-form mt-0 col-sm-5">
                        {!! Form::label('customer_id', 'Select Customer') !!}
                        {!! Form::select('customer_id', $users, isset(request()->customer_id) ? request()->customer_id : null, ['class' => 'form-control select2']) !!}
                      
                    </div>

                    <!-- Range form -->
                    <div class="md-form mt-0 col-sm-5">
                        {!! Form::label('range', 'Date Range') !!}
                        {!! Form::text('range', null, ['class' => 'form-control']) !!}
                      
                    </div>

                    <!-- Range form -->
                    <div class="md-form mt-0 col-sm-2 mt2">
                        <br>                     
                        <button class="btn btn-info" type="submit">Search <i class="fa fa-search"></i></button>                      
                    </div>

                {!! Form::close() !!}
            <div class="box-body">

            </div>
        </div>
        <div class="text-center" style="background: white; border-top: 3px solid green;">
                
                @if (isset($orders) || isset(request()->range))

                    @if (count($orders)>0)
                        
                        @include('orders.table_list')
                    
                    @else

                        <b>Por favor selecciona Customer, rango de fecha y da click en buscar.</b>
                        

                    @endif
          
                @endif
                
        </div>
    </div>
@endsection

