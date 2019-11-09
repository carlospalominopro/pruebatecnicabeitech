<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $orders = \DB::table('order')->select('*')->orderBy('order_id','DESC')->get();

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    public function store(Request $request)
    {
        if(isset($request['customer_id']) && isset($request['creation_date'])&& isset($request['delivery_address'])&& isset($request['total'])){

            $order_req = $request->only('customer_id','creation_date','delivery_address','total');

            $order = \DB::table('order')->insertGetId($order_req);
            
            return $this->sendResponse($order->toArray(), 'Order saved successfully');
        }
        else{

            return $this->sendError('Incomplete Fields');

        }

    } 
}
