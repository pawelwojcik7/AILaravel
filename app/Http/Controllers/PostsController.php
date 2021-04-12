<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get(); //pobranie wszystkich postów z bazy i 
                                                            //posegregowanie od najwczesniej dodanego do najstarszego
        return view('posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('postAdd',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->tresc = $request->message;
        if($post->save())
        {
            return redirect()->route('/');
        }
        return "Wystapił błąd!!!";
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
        if(Auth::user()!=null){
        $post = Post::find($id);
        return view('postsEditForm', compact('post'));
        }
        return "error!";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request,[      
            'message' => 'required|min:30|max:400'  , //sprawdzanie czy nie pusty|min 30 znakow| max 400 znaków
            'title' => 'required|min:5',   
        ],
        [
            'message.required'=>'Wprowadź wiadomość.',          //Wiadomosci zwrotne gdy wykryje błąd
            'message.min'   => 'Wprowadz minimum 30 znaków.',
            'title.min' => 'Tytuł powinien mieć minimum 5 znakóww' ,
        ]);

        $post = Post::find($id); //szukanie posta  o podanym $id w bazie 
        $post->title = $request->input('title');
        $post->tresc = $request->input('message');  //zaktualizowanie treści wiadomosci
       $post->save();           //zapisanie zmian w bazie
  

       return back()->with('success','Pomyślnie zmieniono treść.'); //powrót na poprzednią strone wraz z wiadomością o 
                                                                    // udanej aktualizacji
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $post = Post::find($id);

        $post->delete();
        return back()->with('success','Usunięto post!');
       
     
    }
}
