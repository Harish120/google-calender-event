<!DOCTYPE html>
<html>
<head>
    <title>Google Calendar Events</title>
</head>
<body>
<h1>Google Calendar Events</h1>
<button onclick="location.href='/connect'">Connect to Google Calendar</button>


<?php if (!empty($events)): ?>
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <?= htmlspecialchars($event->getSummary()) ?> -
                <?= htmlspecialchars($event->getStart()->getDateTime()) ?>
                <form action="/calendar/delete/<?= htmlspecialchars($event->getId()) ?>" method="post" style="display:inline;">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No events found.</p>
<?php endif; ?>
</body>
</html>
