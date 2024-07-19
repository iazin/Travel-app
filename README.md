# Travel-app

## Description

Travel-app is a web application that allows users to manage their travel plans. Users can create, edit, and delete trips, as well as manage their account information. The application includes features such as user registration, authorization, and automatic data saving to a server-side SQLite database. The frontend is styled using Bootstrap.

## Features

- *Trip Management:*
  - Create, edit, delete trips
  - Trip fields: 
    - *Title:* The name of the trip
    - *Start Date:* The start date of the trip
    - *End Date:* The end date of the trip
    - *Place:* The destination of the trip
    - *Description:* Detailed description of the trip
- *User Account Management:*
  - Registration
  - Authorization
  - Edit account information
  - Delete account
  - View account information
- *Automatic Data Saving:* Data is automatically saved in a server-side SQLite database.

## Technology Stack

- *Backend:* PHP
- *Frontend:* HTML, Bootstrap
- *Database:* SQLite

## Getting Started

### Prerequisites

To run this project locally, you will need:

- Visual Studio Code installed
- PHP Server extension for VS Code installed
- PHP installed
- SQLite installed

### Installation

1. Clone the repository:
```sh
   git clone https://github.com/iazin/Travel-app.git
```
2. Navigate to the project directory:
```sh
   cd Travel-app
```

### Running the Project

1. Open the project in Visual Studio Code.
2. Open the command palette (Ctrl+Shift+P or Cmd+Shift+P on Mac) and type "PHP Server: Serve project".
3. Select the option to serve the project. This will start a local PHP server and provide a URL (e.g., http://localhost:3000).
4. Open your web browser and navigate to the provided URL to start using the Travel-app application.

## Usage

1. *Register:* Create a new account by filling in the registration form.
2. *Log In:* Log in with your credentials.
3. *Create a Trip:* Fill in the trip details and save.
4. *Edit trip:* Click the edit button on the trip card to change the trip details and save the changes.
5. *Delete trip:*Click the delete button on the card of the trip you want to delete.
6. *Manage Account:* View, edit, or delete your account information.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
