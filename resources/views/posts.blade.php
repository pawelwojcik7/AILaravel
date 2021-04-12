<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Aktualnosci</title>
   @include('head')
</head>
<body>
@include('layouts.navbar')
@Auth
 
<div id="postKontener">
  
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
              </div>
               @endif 
                 @if ($message = Session::get('error'))
               <div class="alert alert-danger alert-block">
                   <button type="button" class="close" data-dismiss="alert">×</button>	
                       <strong>{{ $message }}</strong>
                     </div>
                      @endif

                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
        <div id="postKontenerNaglowek">AKTUALNOŚCI</div>
        @if(Auth::user()->status!=1)
       


                                  <!-- Przycisk do zamknij pozycje modalny -->
 <button id="postDodaj" type="button" class="btn btn-success" data-toggle="modal" data-target="#nowy">
    Dodaj nowy post
    </button>
    <!-- Okienko wyskakujące -->
    <div class="modal fade" id="nowy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edycja postu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form role="form"  action="{{ route('store') }}" id="comment-form" 
            method="post" enctype="multipart/form-data" >
        @csrf
        <div class="box">
          <div class="box-body">
            <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
            <label><b>Tytuł</b></label> <br>
             <textarea name="title" id="message" cols="50" rows="1" required></textarea><br />
             <label><b>Treść</b></label> <br>
             <textarea name="message" id="message" cols="50" rows="3" required></textarea>
            </div>
          </div>
         </div>
       <div class="box-footer"><button type="submit" class="btn btn-success">Utwórz</button> 
       </div>
      </form>
          </div>
          <div class="modal-footer">
          <a style="color: white" id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
          </div>
        </div>
      </div>
    </div>



        @endif
        @foreach ($posts as $item)
        <div id="post">
            <div id="postTytul">
               {{ $item->title}}
            </div>
            <div id="postTresc">
                {{$item->tresc}}
            </div>

            <div id="parentPost">
                <div id = "lewaPost"><div id="tytul">Autor: &nbsp; {{Auth::user()->name}} </div></div>
                <div id = "prawaPost"> <div id="Godzina dodania">Godzina utworzenia: &nbsp; {{$item->created_at}} </div> </div></div>
              
                @if(Auth::user()->status!=1)
                <div id="przyciskiPost">
               
                    



                    <!-- Przycisk do zamknij pozycje modalny -->
 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edytuj{{$item->id}}">
    Edytuj
    </button>
    <!-- Okienko wyskakujące -->
    <div class="modal fade" id="edytuj{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edycja postu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="form-group" >
            <form action="{{ route('update', $item->id) }}" method="get">
              <label><b>Tytuł</b></label> <br>
               <textarea name="title" id="message" cols="30" rows="1" required >{{$item->title}}</textarea><br/>
             <label><b>Wprowadź nowy tekst</b></label><br>
             <textarea name="message" id="message" cols="50" rows="10" required>
                {{$item->tresc}}
              </textarea>

              <button type="submit" class="btn btn-success form-control">Zapisz zmiany</button>
           </form>
          
         </div>
          </div>
          <div class="modal-footer">
          <a style="color: white" id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
          </div>
        </div>
      </div>
    </div>



    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#usun{{$item->id}}">
        Usuń
        </button>
        <!-- Okienko wyskakujące -->
        <div class="modal fade" id="usun{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuwanie postu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <div class="form-group" >
                <form action="{{ route('delete', $item->id) }}" method="get">
                    Czy na pewno chcesz usunąć ten post?<br/><br/>
                  <button type="submit" class="btn btn-success form-control">Tak</button>
               </form>
              
             </div>
              </div>
              <div class="modal-footer">
              <a style="color: white" id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
              </div>
            </div>
          </div>
        </div>
    


                </div>
                @endif
         
            </div>

        
        @endforeach
       




@endAuth
@guest
@include('gosc')
@endguest
</div>

<!--


    <div class="table-container">
        <div class="title">
            <h3>Aktualności</h3>
        </div>
        
        <table data-toggle="table">
        @foreach($posts as $post)
            <thead>
                <tr>
                    <th colspan="5">{{$post->title}}</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td colspan="5">{{$post->tresc}}
                        <br />
                        @Auth
                        @if(Auth::user()->status!=1)
                        <a href="{{ route('edit', $post) }}" class="btn btn-success btn-xs" title="Edytuj"> Edytuj
                        </a>
                        @endif
                        @endAuth
                        </td>
                    </tr>
                    <tr>
                    <td>Autor:</td>
                    <td>{{$post->user->name}}</td>
                    <td>Data dodania:</td>
                    <td>{{$post->created_at}}</td>
                    @Auth
                        @if(Auth::user()->status!=1)
                    <td><a href="{{ route('delete', $post) }}" class="btn btn-danger btn-xs"
                            onclick="return confirm('Jesteś pewien?')" title="Skasuj"><i class="fa fa-trash-o"></i> Usuń
                        </a></td>
                        @endif
                        @endAuth
                    </tr>
                    
             </tbody>
             @endforeach
        </table>
        <br>
        @Auth
        @if(\Auth::user()->id==1)
        <div class="footer-button">
            <a href="{{ route('store') }}" class="btn btn-secondary">Dodaj</a>
        </div>
        @endif
        @endAuth
    </div>      -->
        @include('stopka')
</body>
</html>