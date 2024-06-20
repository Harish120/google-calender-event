<?php

// Function to generate README.md content
function generateReadmeContent() {
    return <<<README
# Google Calendar Integration with PHP MVC

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
- Google API credentials (OAuth client ID and secret)

## Installation

1. **Clone the repository**

   \`\`\`bash
   git clone https://github.com/your/repository.git
   cd repository
   \`\`\`

2. **Install dependencies**

   \`\`\`bash
   composer install
   \`\`\`

3. **Set up Google API credentials**

   - Create a project in Google Cloud Console: [Google Cloud Console](https://console.cloud.google.com/)
   - Enable Google Calendar API and create OAuth client credentials (OAuth client ID and secret)
   - Download \`credentials.json\` and place it in the root directory of the project.

4. **Configure environment variables**

   - Copy \`.env.example\` to \`.env\` and set your environment variables, including \`GOOGLE_CLIENT_ID\` and \`GOOGLE_CLIENT_SECRET\`.

5. **Run the application**

   - Start the PHP development server:

     \`\`\`bash
     php -S localhost:8000 -t public
     \`\`\`

   - Access the application in your browser at \`http://localhost:8000\`.

## Usage

- **Connecting to Google Calendar:**
  - Navigate to \`/connect\` to authorize the application to access your Google Calendar.

- **Listing Events:**
  - After connecting, visit \`/calendar\` to view events. Events are categorized into Upcoming and Archived (older than 2 years).

- **Creating Events:**
  - Use the "Create Event" button on the homepage (\`/\`) to add new events to your Google Calendar.

- **Deleting Events:**
  - Events can be deleted from the \`/calendar\` view by clicking on the delete button next to each event.

- **Disconnecting Google Calendar:**
  - To disconnect your Google Calendar account, visit \`/disconnect\`.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your proposed changes.

## License

This project is licensed under the [MIT License](LICENSE).
README;
}

// Generate README content
$readmeContent = generateReadmeContent();

// Print or save the generated content
echo $readmeContent;
