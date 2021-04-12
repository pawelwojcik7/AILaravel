<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class myOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $orders = Order::where('user_id','=',Auth::User()->id)->orderBy('data','asc')->get();
        $date = date('Y-m-d');
        return view('myOrders', compact('orders','date'));
        
       
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
        
        $order = Order::find($id);
        return view('myOrdersEditForm', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   

        $this->validate($request,[      
            'data'=>'required|after:today',
            'info'=>'required',
            'typ'=>'required',
        ],
        [
            'data.after'=>'Podaj poprawną datę.',
            'data.required'=>'Podaj datę',
            'info.required'=>'Dodaj infromacje',
            'typ.required'=>'Wybierz typ ćwiczeń',
       
        ]);


        $order = Order::find($id);
      
            $order->data = $request->input('data');
            $order->typ = $request->input('typ');
            $order->info = $request->input('info');
          $order->save();
            return back()->with('success',"Edytowano zamówienie.");
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
}
