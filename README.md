## 📘 Laravel User Management System

A simple Laravel-based User Management System with CRUD operations, DataTables, and SweetAlert2 integration.

---

### 🔗 Live Demo

👉 [**View Live Demo**](https://alihussain.com/CSO-Screening-Task)


### 🚀 Features

* 🧑‍💼 CRUD operations for users
* 📊 AJAX-based DataTable
* 🔥 SweetAlert2 for modals and toast notifications
* 🛡️ Laravel Form Request validation
* 🧩 Bootstrap 5 responsive UI

---

### 🧰 Tech Stack

* **Backend**: Laravel 12
* **Frontend**: Bootstrap 5, jQuery, DataTables, SweetAlert2
* **Database**: SQLite

---

### 🛠️ Installation

```bash
git clone https://github.com/alihussain-hsp/CSO-Screening-Task.git
cd CSO-Screening-Task
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Update `.env` with your database credentials before running `migrate`.

---

### 📂 Folder Structure

```bash
app/
  Http/
    Controllers/
    Requests/
resources/
  views/
    users/
      index.blade.php
      edit.blade.php
public/
  screenshots/
```

---

### 📝 Example Environment (.env)

```env
APP_NAME=LaravelUserManager
APP_ENV=local
APP_KEY=base64:...
DB_CONNECTION=mysql
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 📌 How to Use

* Access `/users` route to view all users
* Click "Edit" to open modal
* Submit form via AJAX
* Toast or modal success message appears
* Table refreshes without page reload

---

### 📦 Dependencies

* [SweetAlert2](https://sweetalert2.github.io/)
* [DataTables](https://datatables.net/)
* [Bootstrap 5](https://getbootstrap.com/)

---

### 🙌 Credits

Created by [Ali hussain](https://github.com/alihussain-hsp)
Licensed under MIT

