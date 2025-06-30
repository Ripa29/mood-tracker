# 🌤️ Daily Mood Tracker Web App

A Laravel-based web application that allows users to log their mood daily, view emotional history, track mood trends, and earn streak badges all with a clean, mobile-friendly Bootstrap interface.

---

## 🚀 Features

### 🔐 User Authentication
- Register and login using phone number & password
- Logout
- Secure access: each user can only view their own data

### 📆 Mood Entry (CRUD)
- Select one mood per day (e.g., 😊 Happy, 😢 Sad, 😠 Angry, 😍 Excited)
- Optional short note
- Prevent duplicate entries for the same day
- Edit or soft delete entries

### 📜 Mood History Page
- Chronological list (latest first) of mood logs
- Filter by date range
- Display in table or timeline format

### 📊 Weekly Mood Summary
- Visualize mood distribution using Chart.js bar chart
- Displays weekly mood count (Mon–Sun)
- Each mood represented with a distinct bar color

### ♻️ Soft Delete & Restore
- Soft delete moods instead of permanent deletion
- Restore option from deleted entries page

### 🔥 Streak Badge
- Displays badge if mood is logged 3 or more consecutive days

---

## 🌟 Bonus Features (Optional)
- **Mood of the Month**: Shows the most frequent mood in past 30 days
- **Export as PDF**: Download mood logs in a formatted PDF

---

## 🧰 Tech Stack

| Layer       | Technology              |
|-------------|--------------------------|
| Backend     | Laravel 12            |
| Frontend    | Blade, tailwind css       |
| Charts      | Chart.js                 |
| Database    | MySQL      |
| Auth        | Laravel Breeze   |

---

## 💻 Setup Instructions

1. **Clone Repository**
   
   git clone https://github.com/Ripa29/mood-tracker.git
   cd mood-tracker
   
3. **Install Dependencies**

composer install
npm install && npm run dev

3. **Environment Configuration**

cp .env.example .env
php artisan key:generate

4. **Configure Database**
   Update .env with your DB credentials:
DB_CONNECTION=mysql
DB_DATABASE=mood_tracker
DB_USERNAME=root
DB_PASSWORD= enter your myphpadmin password

5. **Run Migrations**
   
   php artisan migrate

6. **Serve the App**
   
php artisan serve
