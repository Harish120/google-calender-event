<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Calendar Integration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Calendar App</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/calendar">Events</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['access_token'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/disconnect">Disconnect</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/connect">Connect</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container">
    <?php include($view); ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
