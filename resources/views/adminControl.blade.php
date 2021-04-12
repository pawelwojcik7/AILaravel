<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Aktualnosci</title>
  @include('head')
</head>
<body>
@include('layouts.navbar')
<div class="kontenerPanel">
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

@if (Auth::user()->status==1)
 @include('nieuprawniony')
@else

        <div class="title">
            <h3>Złożone zlecenia na treningi</h3>
        </div>

        @foreach ($users as $user)
        <div id="tabelaPanel">
         <table class="table table-hover">
            <tr id="naglowekPanel"><td colspan="4">Zamówienia użytkownika &nbsp;{{$user->name}}</td></tr>
            <tr id="naglowekPanel"><td>Typ ćwiczeń</td> <td>Data ćwiczeń</td> <td>Dodatkowy opis</td> <td>Data utworzenia</td></tr>
            @foreach ($orders as $order)
              @if($user->id == $order->user_id)
              <tr>
                  <td>{{$order->typ}}</td>
                  <td>{{$order->data}}</td>
                  <td>{{$order->info}}</td>
                  <td>{{$order->created_at}}</td>
                  <td>
                            <!-- Przycisk do zamknij pozycje modalny -->
 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edytuj{{$order->id}}">
    Edytuj
    </button>
    <!-- Okienko wyskakujące -->
    <div class="modal fade" id="edytuj{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form role="form" id="comment-form" method="get" enctype="multipart/form-data" 
                action="{{ route("updateAdmin", $order) }}">
                    {{ csrf_field() }}
                    
                    <div class="box">
                        <div class="box-body">
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}" id="roles_box">
                            
                                <label><b>Treść</b></label><br>
                                <textarea name="info" id="message" cols="50" rows="3" required>
                               {{$order->info}}
                                </textarea>
                                <input id="date" type="date"  class="form-control @error('email') is-invalid @enderror" name="date" required  value="{{$order->data}}">
                              
                              
                            </div>
                            <div class="box-footer">
                        <button type="submit" class="btn btn-success">Zapisz</button>
                    </div>
                        </div>
                    </div>
                    
                </form>
          
         </div>
          </div>
          <div class="modal-footer">
          <a style="color: white" id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
          </div>
        </div>
      </div>
    </div>

                  </td>
                  <td>


                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#usun{{$order->id}}">
                        Usuń
                        </button>
                        <!-- Okienko wyskakujące -->
                        <div class="modal fade" id="usun{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <form action="{{ route('deleteOrder', $order->id) }}" method="get">
                                    Czy na pewno chcesz usunąć to zamowienie?<br/><br/>
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



                  </td>
              </tr>
              @endif
            @endforeach
            </table>
        </div>
        @endforeach
        </div> 
@endif

@include('stopka')

</body>
</html>