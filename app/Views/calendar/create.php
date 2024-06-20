<div class="container my-5">
    <h2 class="text-center">Create a New Event</h2>
    <form action="http://localhost:8000/calendar/create" method="post">
        <div class="form-group">
            <label for="summary">Event Summary</label>
            <input type="text" class="form-control" id="summary" name="summary" required>
        </div>
        <div class="form-group">
            <label for="start">Start Date and Time</label>
            <input type="datetime-local" class="form-control" id="start" name="start" required>
        </div>
        <div class="form-group">
            <label for="end">End Date and Time</label>
            <input type="datetime-local" class="form-control" id="end" name="end" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
