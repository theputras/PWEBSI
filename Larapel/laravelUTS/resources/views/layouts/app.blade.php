<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT FITKOM JAYA')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        :root {
            --primary-color: #662222;   /* Burgundy Tua */
            --secondary-color: #842A3B; /* Burgundy Cerah */
            --accent-color: #A3485A;    /* Aksen Lembut */
            --highlight-color: #F5DAA7; /* Cream Cerah */
            --white: #ffffff;
        }

        /* Background Body (Cream Cerah) */
        body {
            background-color: var(--highlight-color);
            color: var(--primary-color); /* Teks utama jadi Burgundy */
            font-family: 'Arial', sans-serif;
        }

        /* Navbar (Header) Burgundy */
        .navbar {
            background-color: var(--primary-color) !important;
        }
        .navbar a {
            color: var(--white);
        }
        .navbar a:hover {
            color: var(--highlight-color);
        }

        /* Table Header (Burgundy Cerah) */
        .table thead th {
            background-color: var(--secondary-color);
            color: var(--white);
        }
        
        /* Judul H1 (Burgundy Cerah) */
        h1 {
            color: var(--secondary-color);
        }

        /* Card Header (Burgundy Cerah) */
        .card-header {
            background-color: var(--secondary-color);
            color: var(--white);
            font-weight: bold;
        }

        /* --- KUSTOMISASI TOMBOL --- */
        
        /* Tombol Biru standar -> jadi Burgundy Tua */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--white);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /* Tombol Kuning (Edit) -> jadi Aksen Lembut */
        .btn-warning {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--white);
        }
        .btn-warning:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        /* Tombol Merah (Delete) - kita biarkan standar Bootstrap agar tetap mencolok */
         .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
         }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">PT FITKOM JAYA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('vehicles*') ? 'active' : '' }}" href="{{ route('vehicles.index') }}">Vehicles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('warehouses*') ? 'active' : '' }}" href="{{ route('warehouses.index') }}">Warehouses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">Transactions</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>