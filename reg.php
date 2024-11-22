<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTC to USD Exchange Rate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">BTC to USD Exchange Rate</h1>
    
        <div class="card shadow-sm p-4 mb-2">
            <h2 class="card-title text-center">Current Rate: <span id="rate">Loading...</span></h2>
            <p id="trend" class="text-center"></p>
        </div>

        <div class="card shadow-sm p-4">
            <h3 class="card-title mb-3">Rate History</h3>
            <ul id="rate-history" class="list-group">
            <li class="list-group-item">No data yet</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
