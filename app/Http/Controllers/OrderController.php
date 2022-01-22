<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Models\sales;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receipt_id = Receipt::create([]);

        $inputs = $request->except('_method', '_token');

        // $receipt_product[] = [];
        $c=0;
        foreach ($inputs as $key=>$value) {

            foreach($value as $k=>$v){

                // $v['price_sold'] = str_replace(' GHS','',$v['price_sold']);

                 //update product quantity
                 $product = Product::find($v['product_id']);
                 $product->quantity_available = $product->quantity_available - $v['quantity'];
                 $product->save();

                 Order::create([
                    'receipt_id' => $receipt_id->id,
                    'product_id' => $v['product_id'],
                    'price_sold' => $product->min_price,
                    'quantity' => $v['quantity'],
                    'served_by' => Auth::id(),
                    'customer_name' => $inputs['cart'][0]['customer_name'],
                    'customer_location' => $inputs['cart'][0]['customer_location'],
                    'date' => Carbon::today()->toDateString()
                 ]);



            }
        }

        return 'success';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function receipt()
    {
        $last_receipt = Receipt::latest()->first();
        $orders = $last_receipt->orders;

        foreach($orders as $order){
            Arr::add($order, 'price', $order->product->price);
            Arr::add($order, 'brand_name', $order->product->brand_name);
            Arr::add($order, 'model_name', $order->product->model_name);
        }
        return view('print_receipt', compact('orders'));
    }
}
