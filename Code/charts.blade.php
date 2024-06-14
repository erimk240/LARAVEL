<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Crypto Grafiek</title>
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
        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 50px;
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
                        <a class="nav-link active" href="{{ url('/charts') }}">Live Crypto Grafiek</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="my-4">Live Crypto Grafiek</h1>
        <div class="mb-3">
            <label for="cryptoSelect" class="form-label">Selecteer een Cryptocurrency:</label>
            <select class="form-select" id="cryptoSelect">
                @foreach($topCryptos as $crypto)
                    <option value="{{ $crypto }}">{{ $crypto }}</option>
                @endforeach
            </select>
        </div>
        <div class="chart-container">
            <canvas id="liveChart"></canvas>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Crypto Tracker. All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('liveChart').getContext('2d');
            const liveChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'BTC-EUR',
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        data: []
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Tijd'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Prijs (EUR)'
                            }
                        }
                    }
                }
            });

            function updateChart(crypto) {
                fetch(`/live-data?market=${crypto}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.price) {
                            const currentTime = new Date().toLocaleTimeString();
                            liveChart.data.labels.push(currentTime);
                            liveChart.data.datasets[0].data.push(data.price);

                            if (liveChart.data.labels.length > 30) {
                                liveChart.data.labels.shift();
                                liveChart.data.datasets[0].data.shift();
                            }

                            liveChart.update();
                        } else {
                            console.error('Price data not available');
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            let selectedCrypto = 'BTC-EUR';
            document.getElementById('cryptoSelect').addEventListener('change', function() {
                selectedCrypto = this.value;
                liveChart.data.labels = [];
                liveChart.data.datasets[0].data = [];
                liveChart.data.datasets[0].label = selectedCrypto;
            });

            setInterval(() => updateChart(selectedCrypto), 5000);
        });
    </script>
</body>
</html>
