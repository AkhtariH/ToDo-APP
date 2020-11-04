<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hemran Akhtari">
    <title>ToDo List - @yield('title')</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">

      @section('header')
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('/img/logo.png') }}" alt="" width="72" height="72">
        <h2>ToDo List</h2>
        <p class="lead">This is a ToDo app built for an assessment by Dropper.</p>
      </div>
      @show

      <div class="row">
        <div class="col-md-12 order-md-1">
          @yield('content')
        </div>
      </div>

      @section('footer')
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020 Hemran Akhtari</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">GitHub</a></li>
          <li class="list-inline-item"><a href="#">LinkedIn</a></li>
        </ul>
      </footer>
      @show

    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
  </body>
</html>
