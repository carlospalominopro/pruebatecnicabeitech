<style type="text/css">
    
    #productContainer{
        
        border: .5px solid #3c763d;
        border-radius: 10px;

    }

    #cartContainer{

        border: .5px solid #3c763d;
        border-radius: 10px;

    }

    .card-body{
        background-color: #d6e8f1;
        border: 1px solid #3c763d;
        width: 180px;
    }
    
    .card-body:hover{
        background-color: #d8d8d8;
    }

    .card-body:active{
        background-color: #aeeaaa;
    }

    .badge{
        background-color: #6c3a9e;
    }

    .fa-plus-circle, .fa-minus-circle, .fa-times-circle-o{
        color: white;
    }

    .flex_center{

        display: flex;
        justify-content: center;
        text-align: center;
    }

    .flex_end{

        display: flex;
        justify-content: flex-end;
    }

    #shop_cart{
        display: grid;
        justify-content: center;
        text-align: center;
    }

    .center{
        text-align: center;
    }

    .stt{
        border-radius: 8px;
        margin-left: 11.3em;
        padding: 1px;
    }

    #view_detail{
        border: 1px solid #bfb0b0;
        background-color: #cae8cb;
        border-radius: 15px;
    }

    .dett{
        display: flex;
        justify-content: center;
        margin-bottom: 1em;
    }



</style>


<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    {!! Form::select('customer_id', $users, null, ['class' => 'form-control select2', 'required',  'onchange'=>'getProducts()', 'id'=>'customer_id']) !!}
</div>

<!-- Delivery Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_address', 'Delivery Address:') !!}
    {!! Form::text('delivery_address', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Creation Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('creation_date', 'Creation Date:') !!}
    {!! Form::text('creation_date', null, ['class' => 'form-control','id'=>'creation_date', 'required']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', 0, ['class' => 'form-control', 'required', 'readonly'=>'readonly']) !!}
</div>



<div class="col-sm-12">
    <h4><b>Order Detail - Products by Customer</b><br><br></h4>
</div>


<div class="col-sm-10" id="loading"  style="text-align: center;">
    
    <b style="color: green ">Cargando productos...</b>
    
</div>


<div class="col-sm-12" style="display: flex;">

    <div class="col-sm-8">

        <div class="col-sm-12" style="padding: 30px;" id="productContainer">
            
            {{-- AQUI DENTRO LLEGAN LOS PRODUCTOS DE CADA CUSTOMER --}}

        </div>
        
    </div>

    <div class="col-sm-4" id="cartContainer">
          
            {!! Form::hidden('products[]', null, ['id' => 'products']) !!}  
            {!! Form::hidden('quantity_prod[]', null, ['id' => 'quantity_prod']) !!}
            {!! Form::hidden('totalprice', null, ['id' => 'totalprice']) !!} 

            <div class="col-sm-12 pb-4 flex_center">
                
                <B>Carrito de compra</B>
                
            </div>

            <div class="col-sm-12 flex_center" id="no_count">
                
                <small style="color: green" id="void_car"><b>Carrito vacío, por favor seleccione productos</b></small>

            </div>       

            <div class="col-sm-12" style="height: auto;" id="shop_cart">



            </div>

            <div class="col-sm-12 hide pb-2" style="height: auto;" id="view_detail">
                
                <b class="dett">Shop Cart Detail</b>

                <div class="col-sm-12 pb-2 flex_center">

                    <div class="col-sm-6 flex_end">
                        <b>Cantidad Productos:</b>     
                    </div>

                    <div class="col-sm-6 center">
                        <b id="product_quantity">0</b>
                    </div>
                    
                </div>

                <div class="col-sm-12 pb-2 flex_center">

                    <div class="col-sm-6 flex_end">
                        <b>Subtotal:</b>     
                    </div>

                    <div class="col-sm-6 center">
                        <b id="sub_total_fac">0</b>
                    </div>
                    
                </div>

                <div class="col-sm-12 pb-2 flex_center">

                    <div class="col-sm-6 flex_end">
                        <b>Total :</b>     
                    </div>

                    <div class="col-sm-6 center">
                        <b id="total_fac">0</b>
                    </div>
                    
                </div>


            </div>

        
                        
        
    </div>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="margin-top: 50px">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancelar</a>
</div>

@section('scripts')
    
    <script type="text/javascript">

        var products_cart = [];
        
        $(document).ready(function() {

            $('.select3').select2({
                theme: "classic",
                maximumSelectionLength: 5 //Maximo de productos a seleccionar

            })

            $('#customer_id').change();
        })

        $('#form_store').submit(function(event){


            var count_shop_cart = $("#shop_cart section").children().length;


            if(count_shop_cart>0 && products_cart.length>0)
            {
                var products = $('#products');

                products.val(products_cart);

                //PRODUCTOS

                var q;

                var quantity_prod = {};

                for(var i=0; i<products_cart.length; i++){
                    
                    q = '#count_prod'+products_cart[i];

                    quantity_prod[products_cart[i]]= $(q).val();

                }

                $('#quantity_prod').val(JSON.stringify(quantity_prod));

                $('#totalprice').val(parseInt($('#total_fac').text()));

                $(this).submit();

            }
            else{

                event.preventDefault();

                alert('Por favor agrega productos al carrito de compra')
            }
            

        });

        function getProducts(){

            products_cart = [];

            $("#shop_cart").children().remove();
            $("#view_detail").addClass('hide');

            

            var cajaprod = $('#productContainer');

            cajaprod.children().remove();

            cajaprod.addClass('hide');

            $('#loading').removeClass('hide');

            var route = '{{ route('orders.getProducts') }}'
            var token = '{{ session('_token') }}'
            var id = $('#customer_id').val();
            var data = {id: id};

            $.ajax({

                url: route,
                data: data,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': token},

                success:function(response)
                {

                    $.each(response,function(i,value) {

                        var name = "'"+value.name+"'";
                        var price = "'"+value.price+"'";

                        var product = ' \
                        <div class="col-md-3 pb-2 flex_center" id="prod_cart_click'+value.product_id+'" onclick="add_cart('+value.product_id+','+name+','+price+')">\
                            <div class="card product-view">\
                                <div class="card-body p-2 btn btn-light color_orange" title="Añadir al carrito">\
                                    <div class="col-sm-12">\
                                        <div class="col-sm-12">\
                                            <small id="name" style="display: flex; justify-content: center;"><b>'+value.name+'</b></small>\
                                            <small id="name" style="display: flex; justify-content: center;"><b>'+value.product_description+'</b></small>\
                                            <small class=" badge badge-primary">\
                                                <span id="price">$'+value.price+'</span>\
                                                <!--span>/</span-->\
                                                <span id="units"></span>\
                                            </small>\
                                        </div>\
                                    </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        ';

                        cajaprod.append(product);

                    });

                    cajaprod.removeClass('hide');
                    $('#loading').addClass('hide');


                },
                error:function(msj){
                    
                    $('#products').children().remove();
                    $('#products').change();
                    $('#loading').addClass('hide');

                    
                }

            });

        }

        function add_cart(val, name, price){

            $('#void_car').remove();
            
            var shop_cart =  $('#shop_cart');

            var p = '#product_list'+val;

            var exist = $(p);

            if(exist.length == 0){

                var count_shop_cart = $("#shop_cart section").children().length;

                if(count_shop_cart==5)
                {
                    alert('No se pueden agregar más de 5 productos distintos')
                }
                else{

                    var new_product = '\
                        <section>\
                            <div class="card" style="width: 18rem;" id="product_list'+val+'">\
                                <div class="flex_end stt" style="z-index: 1; position: absolute">\
                                    <i title="Eliminar producto" style="font-size: 21px; cursor:pointer;padding:1px; color:#820d0d" onclick="remove_product('+val+')" class="fa fa-times-circle-o"></i>\
                                </div>\
                                <div class="card-body">\
                                    <h5 class="card-title">'+name+'</h5>\
                                    <small class=" badge badge-primary">\
                                        <span id="price_unit'+val+'">'+price+'</span>\
                                        <!--span>/</span-->\
                                        <span id="units"></span>\
                                    </small>\
                                </div>\
                                <div style="display: flex; justify-content: center;">\
                                    <a class="btn rounded-circle btn-danger" onclick="modify_quan('+val+',0)"><i class="fa fa-minus-circle"></i></a>\
                                    <input type="text" id="count_prod'+val+'" value="0" class="center form-control" style="width:7.5em!important; font-weight:bolder">\
                                    <a class="btn rounded-circle btn-info" onclick="modify_quan('+val+',1)"><i class="fa fa-plus-circle"></i></a>\
                                </div>\
                            </div>\
                        </section><br>';

                    shop_cart.append(new_product);

                    $('#view_detail').removeClass('hide');

                    products_cart.push(val);
                    
                    modify_quan(val,1);
                }

            }
            else{

                modify_quan(val,1);
                

            }


        }

        function modify_quan(val,action){

            var quantity = '#count_prod'+val;

            var count_prod = $(quantity);
            
            var value_after = parseInt(count_prod.val());

            //PRECIO UNITARIO DEL PRODUCTO
            var pu = '#price_unit'+val;
            var price_unit_prod = parseInt($(pu).text());


            var product_quantity = parseInt($('#product_quantity').text());

            var sub_total_fac = parseInt($('#sub_total_fac').text());

            var total_fac = parseInt($('#total_fac').text());

            if(action==1){

                value_after = value_after+1;

                //CANTIDAD ACTUAL DEL PRODUCTO
                
                count_prod.val(value_after);

                var quan_prod = parseInt(count_prod.val());


                //CALCULO CANTIDAD
                $('#product_quantity').text(product_quantity+1);

                //CALCULO SUBTOTAL
                var subt = sub_total_fac+(price_unit_prod*quan_prod)-(price_unit_prod*(quan_prod-1));
                $('#sub_total_fac').text(subt);

            }
            else{

                if(value_after>1){

                    value_after =  value_after-1;
                    
                    count_prod.val(value_after);

                    //CANTIDAD ACTUAL DEL PRODUCTO
                    var quan_prod = parseInt(count_prod.val());


                    //CALCULO CANTIDAD
                    $('#product_quantity').text(product_quantity-1);

                    //CALCULO SUBTOTAL
                    var subt = sub_total_fac+(price_unit_prod*quan_prod)-(price_unit_prod*(quan_prod+1));
                    $('#sub_total_fac').text(subt);

                }
                else{
                    value_after = 1;

                    count_prod.val(value_after);
                }

            }

            //CALCULO TOTAL A PAGAR
            var tot = (parseInt($('#sub_total_fac').text()));
            $('#total').val(tot);
            $('#total_fac').text(tot);


        }

        function remove_product(val){

            var p = '#product_list'+val;

            var product_delete = $(p);

            product_delete.remove();

            var count = $("#shop_cart section").children().length;

            if(count==0){

                $('#no_count').append('<small style="color: green" id="void_car"><b>Carrito vacío, por favor seleccione productos</b></small>');

                $('#product_quantity').text("0");

                $('#sub_total_fac').text("0");

                $('#total_fac').text("0");

                $('#view_detail').addClass('hide');

                $('#total').val('0');

            }           

            var index = products_cart.indexOf(val.toString());

            if (index > -1) {
              products_cart.splice(index, 1);
            }

        }

    </script>

@endsection
