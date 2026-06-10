# SEAIT - South East Asian Institute of Technology

A comprehensive Learning Management System (LMS) built with Laravel for educational institutions.

## Features

- **Multi-role Authentication System**
  - Admin: Full system management
  - Faculty: Course and content management
  - Students: Course access and submissions
  - Department Heads: Department oversight

- **Learning Management System (LMS)**
  - Course management
  - Assignment creation and submission
  - Material sharing
  - Quiz system
  - Discussion forums
  - Evaluation system

- **Academic Management**
  - Department management
  - Subject management
  - Student enrollment
  - Faculty management

- **Modern UI/UX**
  - Responsive design with Tailwind CSS
  - Role-based navigation
  - Interactive dashboards
  - Mobile-friendly interface

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and npm (for frontend assets)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd seait-laravel-new
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=seait_laravel
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Set up storage links**
   ```bash
   php artisan storage:link
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Users

After running the seeder, the following users will be created:

### Admin
- Email: `admin@seait.edu`
- Password: `password`

### Faculty
- Email: `john.smith@seait.edu`
- Password: `password`
- Email: `sarah.johnson@seait.edu`
- Password: `password`
- Email: `michael.brown@seait.edu`
- Password: `password`

### Students
- Email: `alice.johnson@student.seait.edu`
- Password: `password`
- Email: `bob.wilson@student.seait.edu`
- Password: `password`
- Email: `carol.davis@student.seait.edu`
- Password: `password`

### Department Head
- Email: `robert.wilson@seait.edu`
- Password: `password`

## Project Structure

```
seait-laravel-new/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Http/Middleware/     # Custom middleware
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/               # Stylesheets
│   └── js/                # JavaScript files
├── routes/
│   └── web.php            # Web routes
└── config/                # Configuration files
```

## Key Features Implementation

### Role-Based Access Control
- Uses Spatie Laravel Permission package
- Custom middleware for role checking
- Role-specific routes and views

### Learning Management System
- Course creation and management
- Assignment submission system
- Quiz creation and grading
- Discussion forums
- Material sharing

### User Management
- Multi-role user system
- Profile management
- Password reset functionality
- User activity tracking

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Database Refresh
```bash
php artisan migrate:fresh --seed
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support and questions, please contact the development team or create an issue in the repository.
