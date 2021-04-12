<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
     @include('head')
    </head>
    <body>
    @include('layouts.navbar')
    @Auth
        <div class="kontener">
            <div id="addPost">
            <div class="title"> <h3>Dodaj post</h3> </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-primary ">
             <!-- /.box-header -->
             <!-- form start -->
             <form role="form"  action="{{ route('store') }}" id="comment-form" 
                   method="post" enctype="multipart/form-data" >
               {{ csrf_field() }}
               <div class="box">
                 <div class="box-body">
                   <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
                   <label><b>Tytuł</b></label> <br>
                    <textarea name="title" id="message" cols="30" rows="1" required></textarea><br />
                    <label><b>Treść</b></label> <br>
                    <textarea name="message" id="message" cols="30" rows="3" required></textarea>
                   </div>
                 </div>
                </div>
              <div class="box-footer"><button type="submit" class="btn btn-success">Utwórz</button> 
              </div>
             </form>
            </div>
        </div>
    </div>

    @endAuth
    @guest
    <div class="table-container">
        <b>Brak uprawnien</b><br />
        <a href="{{ route('login')}}">Zaloguj się</a>
    </div>
    @endguest
    </body>
</html>