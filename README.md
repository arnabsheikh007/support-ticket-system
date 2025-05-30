# Laravel 12 Support Ticket System

Welcome to the Laravel 12 Support Ticket System! This application provides a robust platform for managing support tickets, designed for admins, users, and support engineers. It allows users to create tickets, support engineers to claim and resolve them, and admins to oversee the entire process.

## Table of Contents

-   [Features](#features)
-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
-   [Database Diagram](#database-diagram)
-   [Usage](#usage)
-   [Roles and Permissions](#roles-and-permissions)
-   [License](#license)

## Features

-   User authentication and role-based access control (Admin, User, Support Engineer).
-   Ticket creation, viewing, and management.
-   Comment system for ticket communication.
-   Admin panel for user and ticket management.
-   Support engineer ticket assignment and status updates.
-   Responsive design with Tailwind CSS styling.
-   Pagination and search functionality for ticket and user lists.

## Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js and NPM
-   MySQL or another supported database
-   Laravel 12.x

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/arnabsheikh007/support-ticket-system.git
cd support-ticket-system
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

Install JavaScript dependencies using NPM:

```bash
npm install
```

### 3. Configure Environment

Copy the `.env.example` file to `.env` and configure your settings:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Generate an application key:

```bash
php artisan key:generate
```

### 4. Set Up the Database

Run the migrations to create the necessary tables:

```bash
php artisan migrate
```

Seed the database with initial data (e.g., an admin user):

```bash
php artisan db:seed
```

### 5. Compile Assets

Compile the CSS and JavaScript assets:

```bash
npm run dev
```

### 6. Start the Development Server

Run the Laravel development server:

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the application.

## Database Diagram

![Database Diagram](db-diagram.png)

### Relationship

### Users ↔ Tickets

-   **One-to-Many (via `user_id`)**: A user can create many tickets. A ticket belongs to one user.
    -   **Foreign Key**: `tickets.user_id → users.id`
    -   **Constraint**: `onDelete('cascade')` (If a user is deleted, their tickets are deleted.)
-   **One-to-Many (via `support_engineer_id`)**: A user (with role `support_engineer`) can be assigned to many tickets. A ticket can have one support engineer (nullable).
    -   **Foreign Key**: `tickets.support_engineer_id → users.id`
    -   **Constraint**: `onDelete('set null')` (If a support engineer is deleted, the `support_engineer_id` is set to null.)

### Tickets ↔ Comments

-   **One-to-Many**: A ticket can have many comments. A comment belongs to one ticket.
    -   **Foreign Key**: `comments.ticket_id → tickets.id`
    -   **Constraint**: `onDelete('cascade')` (If a ticket is deleted, its comments are deleted.)

### Users ↔ Comments

-   **One-to-Many**: A user can write many comments. A comment belongs to one user.
    -   **Foreign Key**: `comments.user_id → users.id`
    -   **Constraint**: `onDelete('cascade')` (If a user is deleted, their comments are deleted.)

## Usage

1. **Login**:

    - Use the default admin credentials (set during seeding) or create a new user from admin.
    - _Admin_: `admin@example.com` / `password`
    - _User_: `user@example.com` / `password`
    - _Support Engineer_: `engineer@example.com` / `password`

2. **Roles**:

    - **Admin**: Access `/admin` routes to manage users and tickets.
    - **User**: Access `/tickets` to create and view tickets.
    - **Support Engineer**: Access `/support` routes to claim and manage tickets.

3. **Key Routes**:

    - `/admin/users`: List and manage users.
    - `/admin/users/create`: Create a new user.
    - `/admin/tickets`: List and manage tickets.
    - `/tickets/create`: Create a new ticket.
    - `/support/tickets`: View and manage assigned tickets.

4. **Features**:
    - Create tickets with a title, description, and priority.
    - Add comments to tickets.
    - Admins can assign tickets to support engineers.
    - Support engineers can claim unassigned tickets and update status.

## Roles and Permissions

-   **Admin**: Full access to manage users, assign tickets, update statuses, and add comments.
-   **User**: Can create and view their own tickets, add comments.
-   **Support Engineer**: Can claim unassigned tickets, update status, and add comments only on assigned tickets.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute it as per the license terms.
