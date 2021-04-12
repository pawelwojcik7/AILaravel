<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('title','Zamówienia')
 @include('head')
 
</head>

<body>
    
    @include('layouts.navbar')

    <div id="orderKontener">
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
                        <div id="order">
            <table id="orderTabela" class="table table-hover">
                <tr id="thead"> <td>ID użytkownika</td> <td>Nick</td> <td>E-mail</td><td>Status</td> </tr>
            @if ($users->isEmpty() )
                <tr><td colspan="3">Brak użytkowników</td></tr>
            @else

            @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->status==1)
                            Użytkownik
                        @else
                            Administrator
                        @endif
                        </td>
                        <td>
                           
                                @if ($user->status==1)
                                <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModall{{$user->id}}">
                                    Administrator
                                   </button>
                                   
                                   <!-- Modal -->
                                   <div class="modal fade" id="exampleModall{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel1">Usuwanie pozycji</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button>
                                         </div>
                                         <div class="modal-body">
                                           Czy na pewno chcesz przyznać temu użytkownikowi prawa administratora
                                         </div>
                                         <div class="modal-footer">
                                             <a role="button" href="{{'uprawnienia/1/'.$user->id}}"   class="btn btn-success form-control">Tak</a>
                                           <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
                                          
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                @else
                                   @if (Auth::id()==$user->id)
                                   <button type="button"   disabled  class="btn btn-danger" data-toggle="modal" data-target="#exampleModall{{$user->id}}">
                                    Użytkownik
                                   </button>
                                   @else
                                       
                                   
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModall{{$user->id}}">
                                    Użytkownik
                                   </button>
                                   
                                   <!-- Modal -->
                                   <div class="modal fade" id="exampleModall{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel1">Usuwanie pozycji</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button>
                                         </div>
                                         <div class="modal-body">
                                           Czy na pewno chcesz odebrać temu użytkownikowi prawa administratora?
                                         </div>
                                         <div class="modal-footer">
                                             <a role="button" href="{{'uprawnienia/0/'.$user->id}}"   class="btn btn-success form-control">Tak</a>
                                           <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Anuluj</button>
                                          
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                   @endif
                                @endif
                            
                        </td>

                    </tr>

            @endforeach

            @endif
             </table>
        </div>
        
    </div>  
                      @endif
        

     


    @guest
    @include('gosc')
    @endguest
    @include('stopka')
</body>

</html>
