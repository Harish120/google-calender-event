<div class="my-4">
    <h1 class="text-center">Google Calendar Events</h1>
    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-primary mr-2" onclick="location.href='/connect'">Connect to Google Calendar</button>
        <button class="btn btn-danger" onclick="location.href='/disconnect'">Disconnect</button>
    </div>
    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-success" onclick="location.href='/calendar/create'">Create Event</button>
    </div>
</div>

<?php if (!empty($events)): ?>
    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($event->getSummary()) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($event->getStart()->getDateTime()) ?></p>
                        <form action="/calendar/delete/<?= htmlspecialchars($event->getId()) ?>" method="post">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-center">No events found.</p>
<?php endif; ?>
