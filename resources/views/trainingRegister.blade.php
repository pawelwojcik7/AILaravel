<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezerwacja</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Zarezerwuj trening</div>

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @Auth
                        <form method="post" action="{{ route('storeOrder') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="trainingType"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Typ treningu') }}</label>

                                <div class="col-md-6">

                                    <select name="trainingType">
                                        <option value="Cardio">Cardio</option>
                                        <option value="Silowy">Silowy</option>
                                        <option value="Wyrztmalosciowy">Wytrzymalosciowy</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Data treningu') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date"
                                        class="form-control @error('email') is-invalid @enderror" name="date" required
                                        autocomplete="email">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="informations"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Dodatkowe informacje') }}</label>

                                <div class="col-md-6">

                                    <textarea name="informations" id="message" cols="42" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Zarezerwuj') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endAuth

                        @guest
                        <div class="table-container">
                            <b><a href="{{ route('login')}}">Zaloguj się</a> aby zarezerwować trening</b>

                        </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('stopka')
</body>

</html>
