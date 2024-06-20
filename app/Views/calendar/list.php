<div class="container mt-5">
    <h2>Events</h2>
    <!-- Navigation tabs -->
    <ul class="nav nav-tabs" id="eventTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="archived-tab" data-toggle="tab" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archived Events</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content mt-3" id="eventTabsContent">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
            <!-- Upcoming events -->
            <div class="list-group">
                <?php if (empty($upcomingEvents)): ?>
                    <p class="text-muted">No upcoming events found.</p>
                <?php else: ?>
                    <?php foreach ($upcomingEvents as $event): ?>
                        <div class="list-group-item">
                            <h5 class="mb-1"><?= $event->getSummary() ?></h5>
                            <small><?= $event->getStart()->getDateTime() ?></small>
                            <form action="/calendar/delete/<?= $event->getId() ?>" method="post" class="float-right">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
            <!-- Archived events -->
            <div class="list-group">
                <?php if (empty($archivedEvents)): ?>
                    <p class="text-muted">No archived events found.</p>
                <?php else: ?>
                    <?php foreach ($archivedEvents as $event): ?>
                        <div class="list-group-item">
                            <h5 class="mb-1"><?= $event->getSummary() ?></h5>
                            <small><?= $event->getStart()->getDateTime() ?></small>
                            <form action="/calendar/delete/<?= $event->getId() ?>" method="post" class="float-right">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Create event button -->
    <div class="mt-3">
        <a href="/calendar/create" class="btn btn-primary">Create Event</a>
    </div>
</div>
