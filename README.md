
# Google Calendar Integration with PHP

This project demonstrates integrating Google Calendar API into a PHP application using MVC (Model-View-Controller) pattern.

## Features

- Connect to Google Calendar
- List events from Google Calendar
- Create new events
- Delete events
- Disconnect Google Calendar account

## Prerequisites

Before running the project, make sure you have the following installed:

- PHP (version >= 7.0)
- Composer (for installing dependencies)
- Web server (Apache, Nginx, etc.)

## Installation

1. **Clone the repository**

   git clone via: \
   HTTP: https://github.com/Harish120/intuji-assignment.git \
   SSH: git@github.com:Harish120/intuji-assignment.git \
   cd intuji-assignment

2. **Install dependencies**

   composer install

3. **Configure environment variables**

    - Copy \`.env.example\` to \`.env\` and set your environment variables.

4. **Run the application**

    - Start the PHP development server:

      php -S localhost:8000 -t public

    - Access the application in your browser at \`http://localhost:8000\`.

## Usage

- **Connecting to Google Calendar:**
    - Navigate to \`/List Events\` to authorize the application to access your Google Calendar.

- **Listing Events:**
    - After connecting, visit \`/calendar\` to view events. Events are categorized into Upcoming and Archived (older upto 2 years).

- **Creating Events:**
    - Use the "Create Event" button on the event list page (\`/\`) to add new events to your Google Calendar.

- **Deleting Events:**
    - Events can be deleted from the \`/calendar\` view by clicking on the delete button next to each event.

- **Disconnecting Google Calendar:**
    - To disconnect your Google Calendar account, visit \`/disconnect\`.
