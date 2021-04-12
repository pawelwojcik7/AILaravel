<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Http\Requests\PostRequest;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
                $users = User::orderBy('created_at','asc')->get();
                $orders = Order::orderBy('created_at','asc')->get();
                return view('adminControl', compact('users','orders'));
     
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
        return view('adminEditForm', compact('order'));
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
        $order = Order::find($id);
        
        $this->validate($request,[      
            'info' => 'min:5|max:400' ,
            'date' => 'after:today'  ,   //sprawdzanie czy nie pusty|min 30 znakow| max 400 znaków
        ],
        [
            'message.required'=>'Wprowadź wiadomość.',          //Wiadomosci zwrotne gdy wykryje błąd
           'info.min' => 'Podaj minimum 5 znaków.',
           'date.after' =>'Błędna data rejestracji.',
        ]);


        $order->data=$request->input("date");
        $order->info = $request->info;
        if($order->save()) {
        return redirect()->route('adminPanel');
        }
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order->delete()){
            return redirect()->route('adminPanel');
            }
            return view("Error!!");
    }
    public function uzytkownicy()
    {
        $users = User::all();

        return view('uzytkownicy',compact('users'));

    }
    public function uprawnienia($status,$id)
    {
        $user = User::find($id);
        if($status==0)
        {
          $user->status=1;
          $user->save();
        }
        else
        {
          
          $user->status=2;
          $user->save();  
        }

        return back()->with('success','Zmieniono uprawnienia użytkownika.');
    }
}
