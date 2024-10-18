<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Custom styles if needed */
    </style>
</head>

<body>
    <!-- Simple Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MyApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Common Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <!-- Links for Admin -->
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
                </li>

                @endrole

                <!-- Links for Admin and Manager -->
                @hasanyrole('admin|manager')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Manage Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Manage Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('programs.index') }}">Manage Programs</a>
                </li>
                @endhasanyrole

                <!-- Links for Employee -->
                @role('employee')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">View Orders</a>
                </li>
                @endrole

                <!-- Links for Customer -->
                @role('customer')

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                </li>
                @endrole
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">My Cart</a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
