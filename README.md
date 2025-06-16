# 🚀 Weekly Inqilab Newspaper

A clean and efficient backend for newspaper api:

- ✅ **Multi-authentication** (separate `admin` and `user` tables)
- ✅ **Role-based access control** (RBAC)
- ✅ **Modern UI components**
- ✅ Easy customization for production use

🔗 **Live Preview:** [http://weeklyinqilab.com](http://weeklyinqilab.com)
🔗 **Admin Preview:** [https://admin.weeklyinqilab.com](https://admin.weeklyinqilab.com)

---

## 📦 Installation

Get started in a few simple steps:

```bash
# 1. Clone the repository
git clone https://github.com/your-username/your-repo-name.git

# 2. Navigate to the project directory
cd your-repo-name

# 3. Install PHP dependencies
composer install

# 4. Copy the environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Run migrations and seeders
php artisan migrate --seed
```

---

## 🧪 Usage

### 🔐 Admin Login

> Access the admin dashboard via:

```
http://weeklyinqilab.com/admin/login
```

### 👤 User Login

> Regular users can log in at:

```
http://weeklyinqilab.com/login
```

---

## ✨ Features

- Laravel 12 with Laravel Breeze (Tailwind CSS based)
- Blade UI with responsive design
- Separate authentication guards for Admin and User
- Role & Permission support (can easily integrate Spatie roles)
- Secure login & session management
- Easy to extend for APIs or Jetstream/Inertia setup

---

## 🛠️ Tech Stack

- Laravel 12
- Laravel Breeze
- Blade & Tailwind CSS
- MySQL / PostgreSQL
- Authentication via Laravel Guards
- Role-based access system

---

## 🙌 Contribution

- 👨‍💻 **Backend Developer:** Khandker Shahed  
- 🎨 **Frontend Developer:** Sazeduzzaman Saju

Feel free to fork and contribute by submitting pull requests. For major changes, open an issue first to discuss what you’d like to change.

---

## 📄 License

This project is open-source and available under the [MIT license](LICENSE).

---

> Made with ❤️ for scalable Laravel applications.
