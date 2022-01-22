<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\sales;
use App\Models\repair;
use App\Models\Receipt;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
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
        return view('check_receipt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Receipt $receipt)
    {
        if(!$receipt){
            return back()->with('invalid_receipt', 'Invalid Receipt Entered');
        }

        if($receipt->received_by == null){
            //update cashier who received the funds
            $receipt->update([
                'received_by' => Auth::id()
            ]);

            //convert to event and listeners on update
            //update sales account
            $sales = sales::where(['user_id' => Auth::id(), 'date' => Carbon::today()->toDateString()])->first();

            if ($sales === null) {
                sales::create([
                    'user_id' => Auth::id(),
                    'date' => Carbon::today()->toDateString(),
                    'total' => session('total')
                ]);

            }else{
                // dd($total);
                $sales->update([
                    'total' => $sales->total + session('total')
                ]);
            }

            return back()->with('received', 'Received Successfully');
        }

        return back()->with('already_paid', 'Receipt is Already Paid for');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //print receipt
    public function print_receipt()
    {
        $last_receipt = Receipt::latest()->firstOrFail();
        $orders = $last_receipt->orders;

        foreach($orders as $order){
            Arr::add($order, 'price_sold', $order->price_sold);
            Arr::add($order, 'brand_name', $order->product->brand_name);
            Arr::add($order, 'model_name', $order->product->model_name);
        }
        return view('print_receipt', compact('orders'));
    }


    //check recipt
    public function check(Request $request){
        $data = $request->validate([
            'receipt_id' => 'required|numeric'
        ]);

        $receipt = Receipt::where('id', $data['receipt_id'])->first();

	if(!$receipt){
	   return back()->with('invalid_receipt', 'Receipt Not Found');
	}

        $orders = $receipt->orders;

        if(!$receipt || $orders->isEmpty()){
            return back()->with('invalid_receipt', 'Invalid Receipt Entered');
        }


        $total = 0;

        foreach($orders as $order){
            Arr::add($order, 'price', $order->price_sold);
            Arr::add($order, 'brand_name', $order->product->brand_name);
            Arr::add($order, 'model_name', $order->product->model_name);

            $total = $total + ($order->price_sold * $order->quantity);
        }

        //store in session for receipt update
        session(['total' => $total]);

        return view('check_receipt', compact('orders'));
    }

}
