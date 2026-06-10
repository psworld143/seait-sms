# Testing Guide for SEAIT Laravel Application

This guide provides comprehensive instructions for testing the SEAIT Learning Management System.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Running Tests](#running-tests)
3. [Test Structure](#test-structure)
4. [Manual Testing](#manual-testing)
5. [API Testing](#api-testing)
6. [Browser Testing](#browser-testing)
7. [Performance Testing](#performance-testing)
8. [Security Testing](#security-testing)

## Prerequisites

Before running tests, ensure you have:

1. **PHP 8.1+** installed
2. **Composer** installed
3. **Node.js and npm** installed
4. **MySQL** or **SQLite** for testing database
5. **Laravel Sail** (optional, for Docker environment)

## Running Tests

### 1. Basic Test Commands

```bash
# Run all tests
php artisan test

# Run tests with coverage (requires Xdebug)
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/AuthenticationTest.php

# Run specific test method
php artisan test --filter test_user_can_login_with_valid_credentials

# Run tests in parallel
php artisan test --parallel

# Run tests with verbose output
php artisan test -v
```

### 2. Database Setup for Testing

```bash
# Create test database
php artisan migrate --env=testing

# Refresh test database
php artisan migrate:fresh --env=testing

# Seed test database
php artisan db:seed --env=testing

# Run migrations and seeders for testing
php artisan migrate:fresh --seed --env=testing
```

### 3. Environment Configuration

Create a `.env.testing` file:

```env
APP_ENV=testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_DRIVER=sync
```

## Test Structure

### Feature Tests

Located in `tests/Feature/`:

- **AuthenticationTest.php** - Tests login, registration, logout
- **AdminTest.php** - Tests admin functionality
- **HomeTest.php** - Tests home page functionality
- **RoleMiddlewareTest.php** - Tests role-based access control

### Unit Tests

Located in `tests/Unit/`:

- Model tests
- Service class tests
- Helper function tests

### Test Data Factories

Located in `database/factories/`:

- **UserFactory.php** - User model factory
- **StudentFactory.php** - Student model factory
- **FacultyFactory.php** - Faculty model factory
- **CourseFactory.php** - Course model factory
- **LmsAssignmentFactory.php** - Assignment model factory

## Manual Testing

### 1. User Registration and Login

**Test Steps:**
1. Visit `/register`
2. Fill in registration form with valid data
3. Select a role (student, faculty, head)
4. Submit form
5. Verify redirect to appropriate dashboard
6. Test login with created credentials

**Test Cases:**
- ✅ Valid registration data
- ❌ Invalid email format
- ❌ Weak password
- ❌ Mismatched password confirmation
- ❌ Missing required fields

### 2. Role-Based Access Control

**Test Steps:**
1. Login as different user types
2. Try accessing unauthorized routes
3. Verify proper redirects and error messages

**Test Cases:**
- ✅ Admin can access admin routes
- ✅ Faculty can access faculty routes
- ✅ Students can access student routes
- ✅ Heads can access head routes
- ❌ Unauthorized access attempts
- ❌ Guest access to protected routes

### 3. Admin Dashboard

**Test Steps:**
1. Login as admin user
2. Visit `/admin/dashboard`
3. Verify statistics display correctly
4. Test quick action links
5. Check recent activity section

**Test Cases:**
- ✅ Dashboard loads with correct data
- ✅ Statistics are accurate
- ✅ Quick actions work
- ✅ Navigation is functional

### 4. Home Page

**Test Steps:**
1. Visit home page as guest
2. Check carousel functionality
3. Verify featured courses display
4. Test news section
5. Check responsive design

**Test Cases:**
- ✅ Page loads correctly
- ✅ Carousel slides work
- ✅ Featured courses show
- ✅ News items display
- ✅ Mobile responsive

## API Testing

### Using Postman or Insomnia

1. **Authentication Endpoints:**
   ```
   POST /login
   POST /register
   POST /logout
   POST /forgot-password
   POST /reset-password
   ```

2. **Admin Endpoints:**
   ```
   GET /admin/dashboard
   GET /admin/users
   POST /admin/users
   PUT /admin/users/{id}
   DELETE /admin/users/{id}
   ```

3. **LMS Endpoints:**
   ```
   GET /lms/courses
   GET /lms/courses/{id}
   GET /lms/assignments
   POST /lms/assignments
   ```

### Using Laravel's HTTP Tests

```php
// Example API test
public function test_api_returns_courses()
{
    $response = $this->getJson('/api/courses');
    
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     '*' => ['id', 'name', 'code', 'description']
                 ]
             ]);
}
```

## Browser Testing

### Using Laravel Dusk

1. **Install Dusk:**
   ```bash
   composer require --dev laravel/dusk
   php artisan dusk:install
   ```

2. **Create Browser Tests:**
   ```bash
   php artisan dusk:make LoginTest
   ```

3. **Example Browser Test:**
   ```php
   public function test_user_can_login()
   {
       $this->browse(function (Browser $browser) {
           $browser->visit('/login')
                   ->type('email', 'admin@seait.edu')
                   ->type('password', 'password')
                   ->press('Sign in')
                   ->assertPathIs('/admin/dashboard');
       });
   }
   ```

4. **Run Dusk Tests:**
   ```bash
   php artisan dusk
   ```

## Performance Testing

### Using Apache Bench (ab)

```bash
# Test home page performance
ab -n 100 -c 10 http://localhost:8000/

# Test admin dashboard performance
ab -n 50 -c 5 http://localhost:8000/admin/dashboard
```

### Using Laravel Telescope

1. **Install Telescope:**
   ```bash
   composer require laravel/telescope --dev
   php artisan telescope:install
   php artisan migrate
   ```

2. **Monitor Performance:**
   - Visit `/telescope` in browser
   - Check requests, queries, cache hits
   - Monitor slow queries

## Security Testing

### 1. Authentication Security

**Test Cases:**
- ✅ Password hashing
- ✅ CSRF protection
- ✅ Session management
- ✅ Rate limiting
- ❌ SQL injection attempts
- ❌ XSS attempts

### 2. Authorization Security

**Test Cases:**
- ✅ Role-based access control
- ✅ Permission checking
- ❌ Unauthorized route access
- ❌ Privilege escalation attempts

### 3. Input Validation

**Test Cases:**
- ✅ Valid input acceptance
- ❌ Invalid input rejection
- ❌ Malicious input blocking

## Test Data Management

### Creating Test Data

```php
// Using factories
$user = User::factory()->create();
$student = Student::factory()->create();
$course = Course::factory()->featured()->create();

// Using seeders
php artisan db:seed --class=TestDataSeeder
```

### Test Database Isolation

```php
use RefreshDatabase;

// Each test gets a fresh database
public function test_example()
{
    // Test code here
}
```

## Continuous Integration

### GitHub Actions Example

```yaml
name: Tests
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.1'
        
    - name: Install dependencies
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
      
    - name: Copy environment file
      run: cp .env.example .env
      
    - name: Generate key
      run: php artisan key:generate
      
    - name: Run tests
      run: php artisan test
```

## Troubleshooting

### Common Issues

1. **Database Connection Errors:**
   - Check `.env.testing` configuration
   - Ensure test database exists
   - Verify database permissions

2. **Test Failures:**
   - Check test data setup
   - Verify model relationships
   - Check middleware configuration

3. **Performance Issues:**
   - Use database transactions
   - Optimize database queries
   - Use proper indexing

### Debugging Tests

```php
// Add debugging to tests
public function test_example()
{
    $this->withoutExceptionHandling(); // Show full error details
    
    // Your test code
    dd($result); // Dump and die for debugging
}
```

## Best Practices

1. **Test Naming:**
   - Use descriptive test method names
   - Follow the pattern: `test_[what]_[when]_[expected_result]`

2. **Test Organization:**
   - Group related tests in the same class
   - Use setUp() for common test data
   - Keep tests independent

3. **Test Data:**
   - Use factories for consistent test data
   - Avoid hardcoded values
   - Clean up test data after tests

4. **Assertions:**
   - Use specific assertions
   - Test both positive and negative cases
   - Verify database state changes

5. **Performance:**
   - Use database transactions when possible
   - Avoid unnecessary database queries
   - Use proper indexing for test databases

## Resources

- [Laravel Testing Documentation](https://laravel.com/docs/testing)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Laravel Dusk Documentation](https://laravel.com/docs/dusk)
- [Spatie Permission Testing](https://spatie.be/docs/laravel-permission/v5/testing/testing)
