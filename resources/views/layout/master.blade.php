@php
    use App\Models\category;
    use Illuminate\Http\Request;

    $category = category::all();
@endphp



<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layout.partials.head')

<body>

    @include('layout.partials.preload')
    @include('layout.header')

    @yield('content')

    @include('layout.footer')




</body>

</html>
