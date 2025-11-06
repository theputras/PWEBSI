<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJX3zgJ6V5gD5gN4oN6KoaYvBVo72X3n1+sbIS0Dd0rGoBfnC0rWQZbMzxfF" crossorigin="anonymous">

    <style>
        /* Palet Warna */
        :root {
            --primary-color: #662222; /* Burgundy */
            --secondary-color: #842A3B; /* Ungu Terang */
            --accent-color: #A3485A; /* Aksen Lembut */
            --highlight-color: #F5DAA7; /* Cream Cerah */
            --white: #ffffff; /* Putih */
        }

        body {
            background-color: var(--highlight-color);
            color: var(--primary-color);
            font-family: 'Arial', sans-serif;
        }

        /* Header */
        .navbar {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .navbar a {
            color: var(--white);
        }

        .navbar a:hover {
            color: var(--highlight-color);
        }

        /* Tabel */
        .table {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .table td {
            background-color: var(--white);
        }

        .table tbody tr:nth-child(even) {
            background-color: var(--highlight-color);
        }

        /* Tombol */
        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-warning {
            background-color: var(--accent-color);
            color: var(--white);
        }

        .btn-warning:hover {
            background-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: #ff4444;
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #ff0000;
        }

        /* Card */
        .card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            background-color: var(--secondary-color);
            color: var(--white);
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vehicles">Vehicles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/transactions">Transactions</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb6F8A6tGElP1sbvYgkRrSA6WzNU6l5j4vq9sWzwrQd0d7hXa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-tn5q/j9fuCmrD+vJE8M1OSYl2h9ns1Yv6v7+qR1xV+38g+/gOjZ5tzQJqK9oQ5Uz" crossorigin="anonymous"></script>

</body>
</html>
