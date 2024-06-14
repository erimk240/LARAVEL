<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top 10 Beste Crypto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px; /* Footer height */
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            font-size: 1.25rem;
            padding: 15px;
        }
        .card-body {
            padding: 20px;
            background-color: #fff;
        }
        .card-title {
            font-size: 1.5rem;
            color: #007bff;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .table thead {
            background-color: #343a40;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .table tbody tr {
            border-radius: 0 0 10px 10px;
            background-color: #fff;
        }
        .table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
            padding: 15px;
        }
        .table th {
            font-weight: bold;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .navbar-nav .nav-link.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Crypto Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/top-10') }}">Top 10 Beste Crypto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/charts') }}">Grafieken</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="my-4">Top 10 Beste Crypto</h1>
        <div class="row">
            @foreach($top10 as $crypto)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $crypto['market'] }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${{ number_format($crypto['price'] ?? 0, 2) }}</h5>
                            <p class="card-text">24h Change: {{ number_format($crypto['change24h'] ?? 0, 2) }}%</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Crypto Tracker. All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
