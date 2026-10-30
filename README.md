# Reading List App

A lightweight Laravel application to manage and organize your personal reading list. It allows you to keep track of books you want to read, are actively reading, or have finished, with intuitive capabilities to create, edit, delete, and filter books by their status.

---

## What the App Does

- **View Reading List**: Displays all your books with their title, author, and reading status (or a friendly empty state if no books are added).
- **Add Books**: Simple form to add new books with validation (title and author required, max 255 chars, valid status).
- **Edit Books**: Update any book's title, author, or status pre-filled in an edit form.
- **Delete Books**: Remove books safely with an "Are you sure?" confirmation prompt before deletion.
- **Filter by Status**: Easily filter your reading list with links: **All** · **To read** · **Reading** · **Finished**.

---

## How to Run It

Follow these steps to set up and run the application locally:

### 1. Prerequisites
Ensure you have **PHP 8.2+** with the SQLite extension and **Composer** installed on your machine.

### 2. Install Dependencies
Clone the repository and install the project dependencies:
```bash
composer install
```

### 3. Environment Setup
Create your local environment configuration file:
- On Linux/macOS:
  ```bash
  cp .env.example .env
  ```
- On Windows (PowerShell / Command Prompt):
  ```bash
  copy .env.example .env
  ```

Generate the application encryption key:
```bash
php artisan key:generate
```

### 4. Database Setup & Migration
Prepare the SQLite database and run the migrations:
```bash
php artisan migrate
```
*(If prompted to create the `database.sqlite` file, choose `yes`)*

### 5. Start the Application
Start Laravel's local development server:
```bash
php artisan serve
```

Visit **http://localhost:8000** or **http://localhost:8000/books** in your web browser.

### 6. Running Tests
Run the automated test suite to verify all features:
```bash
php artisan test
```

---

## AI Usage

In accordance with project guidelines, AI assistance (Google Antigravity / Gemini) was utilized during development for:
- Scaffolding the Laravel application configuration and database migration for the `books` table.
- Formulating Eloquent model fillable attributes and controller resource actions.
- Implementing form validation logic and error feedback in Blade templates.
- Writing feature tests covering CRUD operations, status filtering, and confirmation alerts.
