# BASE CMS

**Business Advice and Support for Entrepreneurs**

A Content Management System built with Laravel 12, designed for Edinburgh College's Business Advice and Support for Entrepreneurs (BASE) platform. Features a modern admin interface powered by Material Dashboard 3 with custom BASE branding (Pink #FF4D8D and Yellow #FFD700).

---

## 🚀 Features

- **📝 WordPress-Style CMS** - Pages, Posts, Categories, Tags, and Media Library
- **🎨 Material Dashboard 3** - Beautiful, responsive admin interface
- **👥 User & Role Management** - Fine-grained permissions and access control
- **🏢 BASE-Specific Modules** - Programs, Support Areas, Testimonials, Hero Sections
- **📧 Contact Form Management** - Track and manage contact submissions
- **⚙️ Site Settings** - Organized by groups (General, SEO, Social, Contact)
- **🔍 SEO Management** - Meta tags and descriptions for all content
- **🎯 Menu Builder** - Manage navigation menus by location
- **📱 Responsive Design** - Mobile-friendly front-end and admin
- **🔐 Secure Authentication** - Laravel-native authentication with CSRF protection

---

## 🛠️ Tech Stack

- **Laravel 12** - PHP web application framework
- **PHP 8.2+** - Modern PHP with type safety
- **MySQL** - Relational database
- **Material Dashboard 3** - Admin UI framework
- **Bootstrap 5** - Front-end CSS framework
- **Blade Templates** - Laravel's powerful templating engine

---

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & npm (optional, for asset compilation)

---

## 🛠️ Installation

### 1. Clone the Repository

```bash
cd /path/to/your/webroot
git clone <repository-url> base
cd base
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and configure your settings:

```bash
cp .env.example .env
```

Update the following in your `.env` file:

```env
APP_NAME=BASE
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=base_db
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_PATH=/
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

```bash
mysql -u root -h 127.0.0.1 -e "CREATE DATABASE base_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 6. Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

This will create:
- 26+ database tables
- 3 roles (Administrator, Editor, Author)
- 2 admin users with demo credentials
- Sample content (posts, pages, categories, tags)
- BASE-specific content (6 programs, 8 support areas, 3 testimonials)
- 10 site settings

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Start Development Server

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

---

## 🎯 Getting Started

### Access URLs

- **Front-end:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Admin Login:** [http://127.0.0.1:8000/admin/signin](http://127.0.0.1:8000/admin/signin)
- **Admin Dashboard:** [http://127.0.0.1:8000/admin/dashboard](http://127.0.0.1:8000/admin/dashboard)

### Default Admin Credentials

**Administrator Account:**
- Email: `admin@base-scotland.com`
- Password: `password`

**Editor Account:**
- Email: `editor@base-scotland.com`
- Password: `password`

⚠️ **IMPORTANT:** Change these passwords immediately in production!

---

## 📊 Database Structure

BASE CMS includes 26+ tables organized as follows:

### Core Tables
- `users` - User accounts with soft deletes
- `roles` - Role definitions
- `role_user` - User-role assignments (many-to-many)
- `sessions` - Database-backed sessions

### Content Management
- `posts` - Blog posts/news articles
- `pages` - Static pages with hierarchy
- `categories` - Content categories (hierarchical)
- `tags` - Content tags
- `media` - Media library (images, documents)

### BASE-Specific
- `programs` - Business programs
- `support_areas` - Support service areas
- `testimonials` - Client testimonials
- `hero_sections` - Homepage hero carousel
- `contact_submissions` - Contact form entries

### System
- `settings` - Site-wide settings (grouped)
- `menus` - Navigation menu definitions
- `menu_items` - Menu structure (hierarchical)
- `seo_meta` - SEO metadata (polymorphic)

### Authentication & Cache
- `password_reset_tokens` - Password reset functionality
- `cache` - Application cache
- `jobs` - Queue jobs
- `job_batches` - Batch job tracking
- `failed_jobs` - Failed queue jobs

---

## 🎨 Admin Features

### Dashboard
- Quick statistics overview
- Recent activity
- System status

### Content Management
- **Posts** - Create, edit, publish blog posts with categories and tags
- **Pages** - Manage static pages with parent-child hierarchy
- **Media** - Upload and organize images, documents
- **Categories** - Hierarchical category management
- **Tags** - Simple tag management

### User Management
- **Users** - Create and manage user accounts
- **Roles** - Define roles with granular permissions

### BASE Modules
- **Programs** - Manage business acceleration programs
- **Support Areas** - Define support service areas
- **Testimonials** - Client testimonial management
- **Hero Sections** - Homepage carousel management
- **Contact Submissions** - View and manage form submissions

### Configuration
- **Settings** - Site-wide settings organized by group
  - General (site name, tagline)
  - SEO (meta tags, descriptions)
  - Social (social media links)
  - Contact (contact information)
- **Menus** - Navigation menu builder

---

## 🎨 Branding & Design

### Color Palette
- **Primary Pink:** `#FF4D8D`
- **Accent Yellow:** `#FFD700`
- **Text Dark:** Standard Bootstrap dark text
- **Background:** White and light grays

### Typography
- **Headings:** Bold, gradient effects with primary colors
- **Body:** Clear, readable sans-serif
- **Admin UI:** Material Dashboard 3 default fonts

---

## 🔒 Security

### Built-in Security Features
- CSRF protection on all forms
- Password hashing with bcrypt (12 rounds)
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating
- Rate limiting on authentication
- Session management with regeneration

### Production Checklist
- [ ] Change all default passwords
- [ ] Update `APP_KEY` in `.env`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure proper file permissions
- [ ] Enable HTTPS
- [ ] Review and restrict database user permissions
- [ ] Set up regular backups

---

## 🧪 Development

### Clear Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration (WARNING: deletes all data)
php artisan migrate:fresh

# Fresh migration with seeders
php artisan migrate:fresh --seed
```

### Database Seeding

```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=UserSeeder
```

---

## 📁 Project Structure

```
base/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   └── Auth/           # Authentication controllers
│   │   ├── Middleware/
│   │   └── Requests/
│   └── Models/                  # Eloquent models
├── config/                      # Configuration files
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/                      # Public web root
├── resources/
│   └── views/
│       ├── admin/               # Admin views
│       ├── auth/                # Authentication views
│       ├── layouts/             # Layout templates
│       ├── partials/            # Reusable partials
│       └── sections/            # Page sections
├── routes/
│   ├── web.php                  # Front-end routes
│   ├── admin.php                # Admin routes
│   └── auth.php                 # Auth routes
└── storage/                     # File storage
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License.

---

## 🙏 Acknowledgments

- **Laravel** - The PHP framework for web artisans
- **Material Dashboard 3** - Beautiful admin UI framework by Creative Tim
- **Bootstrap** - Front-end component library
- **BASE Scotland** - Business Advice and Support for Entrepreneurs

---

## 📞 Support

For support, please:
- Check the documentation
- Open an issue on GitHub
- Contact the development team

---

**Built with ❤️ for Scottish Business Growth**
