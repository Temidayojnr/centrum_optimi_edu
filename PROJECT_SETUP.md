# Centrum Optimi Educational Foundation Website

A modern, full-featured website for Centrum Optimi Educational Foundation - an NGO dedicated to unlocking individual excellence through education.

## 🌟 Features

### Public Features
- **Modern Homepage** with hero section, stats, and featured content
- **About Us** page with mission, vision, and values
- **Programs** showcase with detailed program pages
- **Blog/News** section with articles and updates
- **Gallery** for photos and videos
- **Contact Form** with real-time notifications
- **Donation System** integrated with Paystack/Flutterwave
- **Volunteer Application** system
- **Newsletter Subscription** with email verification
- **Responsive Design** - mobile-first approach with Tailwind CSS
- **SEO Optimized** with meta tags and social media integration

### Admin Panel Features
- **Dashboard** with analytics and overview
- **Program Management** - CRUD operations for programs
- **Donation Tracking** - view and manage donations
- **Volunteer Management** - review and approve applications
- **Blog/Post Management** - create and publish content
- **Gallery Management** - upload and organize media
- **Contact Messages** - view and respond to inquiries
- **User Management** - role-based access control (Super Admin, Admin, Content Editor)

## 🛠️ Tech Stack

- **Framework:** Laravel 10.x
- **Frontend:** Tailwind CSS 3.x, Alpine.js
- **Database:** MySQL
- **Build Tool:** Vite
- **PHP Version:** 8.1+
- **Payment:** Paystack & Flutterwave

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- XAMPP (or similar local server)

## 🚀 Installation

### 1. Clone or Navigate to Project
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/backendgo_projects/centrum_optimi_edu_org
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=centrum_optimi_edu
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create Database
Create a MySQL database named `centrum_optimi_edu`

### 7. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

This will create:
- All database tables
- Super Admin (admin@centrumoptimi.org / password123)
- Content Editor (editor@centrumoptimi.org / password123)
- Sample programs and blog posts

### 8. Storage Link
```bash
php artisan storage:link
```

### 9. Build Assets
```bash
npm run build
# or for development
npm run dev
```

### 10. Start Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## 🔐 Admin Access

**Super Admin:**
- Email: admin@centrumoptimi.org
- Password: password123

**Content Editor:**
- Email: editor@centrumoptimi.org
- Password: password123

Admin Panel: http://localhost:8000/admin/login

## 💳 Payment Configuration

### Paystack Setup
1. Sign up at https://paystack.com
2. Get your API keys from Dashboard > Settings > API Keys & Webhooks
3. Add to `.env`:
```env
PAYSTACK_PUBLIC_KEY=pk_test_xxxxx
PAYSTACK_SECRET_KEY=sk_test_xxxxx
```

### Flutterwave Setup
1. Sign up at https://flutterwave.com
2. Get your API keys
3. Add to `.env`:
```env
FLUTTERWAVE_PUBLIC_KEY=FLWPUBK_TEST-xxxxx
FLUTTERWAVE_SECRET_KEY=FLWSECK_TEST-xxxxx
```

## 📧 Email Configuration

For production, configure your mail settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="hello@centrumoptimiedufoundation.org"
```

## 📁 Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Admin panel controllers
│   │   │   └── ...            # Public controllers
│   │   └── Middleware/        # Custom middleware
│   └── Models/                # Eloquent models
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── public/
│   └── logos/                 # Logo images
├── resources/
│   ├── css/                   # Tailwind CSS
│   ├── js/                    # JavaScript & Alpine.js
│   └── views/                 # Blade templates
│       ├── admin/             # Admin panel views
│       ├── layouts/           # Layout templates
│       └── ...                # Public views
└── routes/
    └── web.php                # Application routes
```

## 🎨 Customization

### Brand Colors
Edit `tailwind.config.js` to customize the gold color palette:
```javascript
colors: {
  'gold': {
    // Your custom gold shades
  }
}
```

### Logo
Replace images in `public/logos/` with your own logo files.

### Content
Use the admin panel to:
- Create/edit programs
- Publish blog posts
- Upload gallery images
- Manage users

## 🔒 Security

- All forms are CSRF protected
- Password hashing with bcrypt
- Role-based access control
- Input validation and sanitization
- SQL injection prevention (Eloquent ORM)

## 📱 Mobile Responsive

- Mobile-first design approach
- Touch-friendly interface
- Optimized images
- Fast loading times

## 🌐 SEO Features

- Meta tags for all pages
- Open Graph tags for social sharing
- Twitter Card support
- Sitemap.xml (configure after deployment)
- robots.txt included

## 🤝 Contributing

This is a custom project for Centrum Optimi Educational Foundation. For support or modifications, contact the development team.

## 📄 License

This project is proprietary and confidential.

## 🆘 Support

For technical support or questions:
- Email: developer@example.com
- Documentation: Check this README

## 🎯 Next Steps

1. **Configure Payment Gateways** - Add your Paystack/Flutterwave API keys
2. **Setup Email** - Configure SMTP settings for notifications
3. **Add Content** - Use admin panel to add programs, posts, and gallery items
4. **Customize Branding** - Update colors, logos, and content
5. **Test Thoroughly** - Test all features before going live
6. **Deploy** - Deploy to production server (see deployment guide)

## 📊 Database Models

- **User** - Admin users with role-based access
- **Program** - Educational programs/initiatives
- **Donation** - Donation records and tracking
- **Volunteer** - Volunteer applications
- **Post** - Blog posts and news articles
- **Contact** - Contact form submissions
- **GalleryItem** - Photos and videos
- **Newsletter** - Email subscribers

## 🚦 Status

✅ Database & Models - Complete
✅ Admin Panel - Complete
✅ Public Pages - Complete
✅ Authentication & Authorization - Complete
✅ Payment Integration - Configured (needs API keys)
✅ Frontend Design - Complete (Tailwind CSS)
⏳ Email Notifications - Requires SMTP configuration
⏳ SEO Optimization - Partially complete
⏳ Gallery Images - Needs content upload

---

**Built with ❤️ for Centrum Optimi Educational Foundation**
**Unlocking Individual Excellence Through Education**
