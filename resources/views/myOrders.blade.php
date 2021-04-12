<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    
 @include('head')
 
</head>

<body>
    @section('title','Zamówienia')
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
        <div id="order">
            <table id="orderTabela" class="table table-hover">
                <tr id="thead"> <td>Typ ćwiczeń</td> <td>Data</td> <td>Dodatkowe informacje</td><td></td> </tr>
            @if ($orders->isEmpty() )
                <tr><td colspan="3">Brak zamówień</td></tr>
            @else

            @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->typ}}</td>
                        <td>{{$order->data}}</td>
                        <td>{{$order->info}}</td>
                        <td>
                            <!-- Przycisk do zamknij pozycje modalny -->
 <button id="postDodaj" type="button" class="btn btn-success" data-toggle="modal" data-target="#order{{$order->id}}">
    Edytuj
    </button>
    <!-- Okienko wyskakujące -->
    <div class="modal fade" id="order{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edycja postu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form role="form"  action="{{ route("updateOrder", $order) }}"  id="comment-form" 
            method="get" enctype="multipart/form-data" >
        @csrf
        <div class="box">
          <div class="box-body">
           
         
                    <table id="modalTabela">
                        <tr><td>  Typ treningu <br/>
                             <select style="margin-top: 2%" name="typ">
                             <option value="Cardio">Cardio</option>
                             <option value="Silowy">Silowy</option>
                             <option value="Wyrztmalosciowy">Wytrzymalosciowy</option>
                             </select> 
                         </td></tr>  
                      
                         <tr><td><label for="date"   >Data treningu</label>  
                         <input id="date" type="date" class="form-control @error('email') is-invalid @enderror" name="data" required autocomplete="email">
                            </td></tr>                                  
                            <tr><td>                           
                              <label for="informations"   class="col-md-4 col-form-label text-md-right">{{ __('Dodatkowe informacje') }}</label>
                           
                        <textarea name="info" id="message" cols="42" rows="3"></textarea>
                    </td></tr>

            </table>

            
          </div>
         </div>
       <div id="przyciskPost"><button   type="submit" class="btn btn-success">Zapisz</button> 
       </div>
      </form>
          </div>
          <div class="modal-footer">
          <a style="color: white" id ='anuluj' role="button" data-dismiss="modal" class="btn btn-danger form-control">Anuluj</a>
          </div>
        </div>
      </div>
    </div>
                            
                        </td>

                    </tr>

            @endforeach

            @endif
             </table>
        </div>
        
    </div>

        <!--
    <div class="table-container">
        <div class="title">
            <h3>Moje zamówienia</h3>
        </div>
        @Auth
        <table data-toggle="table">
            @if ($orders->isEmpty() )
                <tr><td style="text-align: center">Brak złożonych zamówień</td></tr>
            @else
                @foreach($orders as $order)
            <tbody>
                    <tr>
                        <td>Rodzaj treningu:</td>
                        <td>{{$order->typ}}</td>
                    </tr>
                    <tr>
                    <td>Termin rezerwacji(na kiedy?)</td>
                    <td>{{$order->data}}
                        @if($order->data>$date)
                    <a href="{{ route('editOrder', $order) }}" class="btn btn-success btn-xs" title="Edytuj"> Edytuj </a>
                    @endif
                    </td>
                    </tr>
                    <tr>
                    <td>Data dodania:</td>
                    <td>{{$order->created_at}}</td>    
                    </tr>
                    <tr>
                        <td>Informacje dodatkowe</td>
                        <td>{{$order->info}}</td>
                    </tr>
                    <tr>
                    <td colspan="2"></td>
                    </tr>
                    
             </tbody>
             
             @endforeach  
            @endif
      
        </table>
        
        @endAuth
        
        </div>
    -->


    @guest
    @include('gosc')
    @endguest
    @include('stopka')
</body>

</html>
