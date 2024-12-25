# FlexMap

**FlexMap** is a workout tracking application that empowers users to plan, record, and monitor their fitness progress. Designed for flexibility, it supports a variety of workout types, including strength training and cardio, allowing users to customize their sessions with standard and user-created exercises. With an intuitive interface built using **Laravel**, **Tailwind CSS**, and **FilamentPHP**, FlexMap provides a seamless experience for tracking workouts, logging exercises, and visualizing fitness achievements.

## Features

- **Workout Session Tracking**: Record start and end times for each session, with a customizable list of exercises.
- **Exercise Logging**: Track sets, reps, weight (for strength exercises), and distance and time (for cardio exercises).
- **Custom Exercises**: Create and save personalized exercises unique to each user, making workout tracking flexible.
- **Progress Mapping**: Monitor trends in workout performance and weight measurements to see progress over time.
- **Templates**: Save session templates for quick setup of recurring workout routines.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Installation](#installation)
3. [Contributing](#contributing)
4. [License](#license)

---

## Getting Started

These instructions will help you get a copy of FlexMap up and running on your local machine for development and testing purposes.

### Prerequisites

- Docker
- Docker Compose

### Technologies Used

- **Backend**: Laravel PHP Framework, FilamentPHP
- **Frontend**: Tailwind CSS
- **Database**: PostgreSQL

---

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/maskeynihal/flexmap.git
   cd flexmap
   ```

### Installing Backend

1. **Start Laravel Sail**:

   ```bash
   ./vendor/bin/sail up
   ```

2. **Install dependencies**:

   ```bash
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ```

3. **Environment Configuration**:

   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Set up your database credentials and other configurations in the `.env` file.

4. **Generate Application Key**:

   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. **Run Migrations**:

   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. **Run Seeder**

   ```bash
   ./vendor/bin/sail artisan db:seed --class=FilamentAdminDashboardAccessDatabaseSeeder
   ```

7. **Access FlexMap**:
   Open `http://localhost:8000` in your browser to access FlexMap.

---

With FlexMap, tracking your workouts and seeing your fitness progress has never been easier. Get started today and make each workout count!
