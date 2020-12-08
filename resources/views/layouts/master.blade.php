<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('index')}}">Online shop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')>
                    <a href="{{route('index')}}">All products</a>
                </li>
                <li @routeactive('categor*')>
                    <a href="{{route('categories')}}">Categories</a>
                </li>
                <li @routeactive('basket')>
                    <a href="{{route('basket')}}">Basket</a>
                </li>
                @guest
                    <li @routeactive('login')>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                    <li @routeactive('register')>
                        <a href="{{route('register')}}">Register</a>
                    </li>
                @endguest

                @auth
                    @admin
                        <li>
                            <a href="{{route('home')}}">Admin Panel</a>
                        </li>
                    @else
                        <li>
                            <a href="{{route('person.orders.index')}}">My orders</a>
                        </li>
                    @endadmin
                    <li>
                        <a href="" disabled>{{auth()->user()->name}}</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{session()->get('success')}}</p>
        @elseif(session()->has('warning'))
            <p class="alert alert-warning">{{session()->get('warning')}}</p>
        @endif
        @yield('content')
    </div>
</div>


</body>
</html>
