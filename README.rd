# LOTR Character List App

A simple Laravel + Vue 3 application for searching Lord of the Rings characters/

## Features

- 🔍 Search for LOTR characters using The One API
- ⚡ Built with Laravel 12, Vue 3 + Vite, TailwindCSS, and Inertia.js
- 🐳 Runs locally with Docker and MySQL

## Setup Instructions

### 1. Clone the Repo

```
git clone https://github.com/jwlewisiii/lotr-api.git
cd lotr-app
```

### 2. Environment Setup

Copy the `.env` file and configure your local settings:

cp .env.example .env

Make sure to update your database credentials if needed.

### 3. Start Docker

docker-compose up --build

This will boot Laravel on [http://localhost:8000](http://localhost:8000) and MySQL on port `3306`.

### 4. Run Migrations

Once the containers are up:

docker exec -it <your_app_container> php artisan migrate

### 5. Access the App

Visit:

http://localhost:8000

Start searching characters

---

## API Endpoints

* `GET /search/name/{name}` – Search characters by name
* `POST /api/lists` – Create a new list
* `GET /api/lists` – Get all lists
* `POST /api/favorites` – Add a character to a list
* `GET /api/favorites` – Get all favorite characters

---

## License

MIT License © 2025

```
