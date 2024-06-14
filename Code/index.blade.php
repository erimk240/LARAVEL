<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crypto Tracker</title>
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
        .search-bar {
            margin-bottom: 20px;
        }
        .news-section {
            margin-top: 40px;
        }
        .news-header {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .news-card {
            margin-bottom: 15px;
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
                        <a class="nav-link" href="{{ url('/top-10') }}">Top 10 Beste Crypto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/charts') }}">Grafieken</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="search-bar">
            <form action="{{ url('/search') }}" method="GET">
                <input type="text" name="query" class="form-control" placeholder="Zoek naar een cryptocurrency...">
            </form>
        </div>
        <div class="row">
            @foreach($markets as $market)
                @php
                    $price = collect($prices)->firstWhere('market', $market['market']);
                @endphp
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            {{ $market['market'] }}
                            <button class="btn btn-sm btn-outline-primary">Favoriet</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${{ number_format($price['price'] ?? 0, 2) }}</h5>
                            <p class="card-text">24h Verandering: {{ number_format($price['change24h'] ?? 0, 2) }}%</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="news-section">
            <h2 class="news-header">Laatste Nieuws</h2>
            <div class="news-card card">
                <div class="card-body">
                    <h5 class="card-title">Cryptocurrency Market Update</h5>
                    <p class="card-text">Get the latest updates on the cryptocurrency market...</p>
                    <a href="#" class="btn btn-primary">Lees Meer</a>
                </div>
            </div>
            <div class="news-card card">
                <div class="card-body">
                    <h5 class="card-title">Bitcoin Price Analysis</h5>
                    <p class="card-text">An in-depth analysis of Bitcoin price trends...</p>
                    <a href="#" class="btn btn-primary">Lees Meer</a>
                </div>
            </div>
            <!-- Add more news cards as needed -->
        </div>
    </div>
    
    <div class="footer">
        &copy; {{ date('Y') }} Crypto Tracker. Alle Rechten Voorbehouden.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>