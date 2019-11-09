<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OrderController extends AppBaseController
{


    public function index(Request $request)
    {

        $orders = \DB::table('order')->select('*')->orderBy('order_id','DESC')->paginate(10);

        $users = [];

        return view('orders.index')
            ->with(['orders'=> $orders, 'users'=>$users]);
    }


    public function create()
    {

        $users = \DB::table('customer')->pluck('name','customer_id');

        return view('orders.create')
            ->with(['users'=>$users]);
    }

    public function getProductsByCustomer(Request $request){

        if(isset($request['id'])){

            $products = \DB::table('product')->select('product.*')->join('customer_product','customer_product.product_id','product.product_id')->where('customer_product.customer_id',$request['id'])->get()->toArray();

            return $products;

        }
    }

    public function store(CreateOrderRequest $request)
    {

        $products = [];

        foreach($request['products'] as $value){
            $products = explode(',', $value);
        }

        $quantity_prod = json_decode($request['quantity_prod'][0],true);
        
        $order_req = $request->only('customer_id','creation_date','delivery_address','total');

        //TRANSACCIÓN TABLA ORDER Y SE RECUPERA EL ID GENERADO
        $order = \DB::table('order')->insertGetId($order_req);

        //ORDER HAS PRODUCTS
        foreach($products as $value){

            $product_detail = \DB::table('product')->where('product_id',$value)->select('*')->first();

            if(isset($product_detail)){

                if($value!=0)
                {

                    $order_det = [
                        'order_id'=>$order,
                        'product_id'=>$value,
                        'product_description'=>$product_detail->product_description,
                        'price'=>$product_detail->price,
                        'quantity'=>$quantity_prod[$value],
                    ];

                    $order_detail = \DB::table('order_detail')->insert($order_det);

                }


            }

        }

        Flash::success('Orden creada correctamente.');

        return redirect(route('orders.index'));
    }

    public function list(Request $request){

        $users = \DB::table('customer')->pluck('name','customer_id');

        $orders = [];

        $products = [];


        if(isset($request['customer_id']) && $request['customer_id']!='' && isset($request['range']) && $request['range']!=''){

            //se separan las fechas del filtro
            list($date_start, $date_end) = explode('TO', $request['range']);

            $orders = \DB::table('order')->where('customer_id',$request['customer_id'])->whereBetween('creation_date',array($date_start, $date_end))->orderBy('order_id','DESC')->get();

            foreach ($orders as $key => $value) {
                
                $order_detail = \DB::table('order_detail')->where('order_id',$value->order_id)->get();

                foreach ($order_detail as $key2 => $value2) {

                    $product_detail = \DB::table('product')->where('product_id',$value2->product_id)->select('*')->first();
                    
                    $products[][$value->order_id] = [

                        'name'=>$product_detail->name,
                        'quantity'=>$value2->quantity,

                    ];

                }
            }

            // foreach ($products as $key => $value) {

            //     print_r($value[368]['name']);
            //     break;
            // }

            // exit;
        }

        return view('orders.list', compact('users','orders', 'products'));
    }
}
