#!/bin/bash

# SEAIT Laravel Application - Test Setup Script
# This script sets up the testing environment and runs tests

echo "🚀 Setting up SEAIT Laravel Testing Environment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "Please run this script from the Laravel project root directory"
    exit 1
fi

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;")
print_status "PHP Version: $PHP_VERSION"

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    print_error "Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    print_warning "Node.js is not installed. Some frontend tests may fail."
fi

# Install PHP dependencies
print_status "Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

if [ $? -ne 0 ]; then
    print_error "Failed to install PHP dependencies"
    exit 1
fi
print_success "PHP dependencies installed"

# Install Node.js dependencies
if command -v npm &> /dev/null; then
    print_status "Installing Node.js dependencies..."
    npm install
    
    if [ $? -ne 0 ]; then
        print_warning "Failed to install Node.js dependencies"
    else
        print_success "Node.js dependencies installed"
    fi
fi

# Copy environment file if it doesn't exist
if [ ! -f ".env" ]; then
    print_status "Creating .env file..."
    cp .env.example .env
    print_success ".env file created"
fi

# Generate application key
print_status "Generating application key..."
php artisan key:generate --no-interaction
print_success "Application key generated"

# Create test environment file
print_status "Setting up test environment..."
cat > .env.testing << EOF
APP_ENV=testing
APP_KEY=base64:$(openssl rand -base64 32)
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_DRIVER=sync
MAIL_DRIVER=array
EOF
print_success "Test environment configured"

# Run migrations for testing
print_status "Running test migrations..."
php artisan migrate --env=testing --force

if [ $? -ne 0 ]; then
    print_error "Failed to run test migrations"
    exit 1
fi
print_success "Test migrations completed"

# Run seeders for testing
print_status "Running test seeders..."
php artisan db:seed --env=testing --force

if [ $? -ne 0 ]; then
    print_warning "Failed to run test seeders"
else
    print_success "Test seeders completed"
fi

# Build frontend assets
if command -v npm &> /dev/null; then
    print_status "Building frontend assets..."
    npm run build
    
    if [ $? -ne 0 ]; then
        print_warning "Failed to build frontend assets"
    else
        print_success "Frontend assets built"
    fi
fi

echo ""
echo "🎯 Testing Environment Setup Complete!"
echo ""

# Ask user if they want to run tests
read -p "Do you want to run the tests now? (y/n): " -n 1 -r
echo ""

if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo ""
    print_status "Running tests..."
    echo ""
    
    # Run tests with different options
    echo "1. Run all tests"
    echo "2. Run tests with coverage (requires Xdebug)"
    echo "3. Run tests in parallel"
    echo "4. Run specific test file"
    echo "5. Run tests with verbose output"
    echo ""
    
    read -p "Select test option (1-5): " -n 1 -r
    echo ""
    
    case $REPLY in
        1)
            php artisan test
            ;;
        2)
            php artisan test --coverage
            ;;
        3)
            php artisan test --parallel
            ;;
        4)
            echo "Available test files:"
            find tests/Feature -name "*.php" -exec basename {} .php \;
            echo ""
            read -p "Enter test file name (without .php): " testfile
            php artisan test "tests/Feature/${testfile}.php"
            ;;
        5)
            php artisan test -v
            ;;
        *)
            php artisan test
            ;;
    esac
    
    if [ $? -eq 0 ]; then
        echo ""
        print_success "All tests passed! 🎉"
    else
        echo ""
        print_error "Some tests failed. Please check the output above."
    fi
else
    echo ""
    print_status "To run tests manually, use:"
    echo "  php artisan test"
    echo ""
    print_status "For more testing options, see TESTING.md"
fi

echo ""
print_status "Setup complete! Happy testing! 🚀"
