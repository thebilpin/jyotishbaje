#!/bin/bash

# Laravel Automation Script
# This script handles common Laravel tasks automatically

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Logging function
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

error() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR: $1${NC}"
}

warning() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}"
}

# Check if PHP is available
check_php() {
    if ! command -v php &> /dev/null; then
        warning "PHP not found in PATH, attempting to use system PHP"
        # Try alternative PHP paths
        for php_path in /usr/bin/php /usr/local/bin/php /opt/php/bin/php; do
            if [ -x "$php_path" ]; then
                alias php="$php_path"
                log "Using PHP at: $php_path"
                return 0
            fi
        done
        error "No usable PHP installation found"
        return 1
    fi
    
    # Test PHP functionality
    if php --version &> /dev/null; then
        log "PHP version: $(php --version | head -n1)"
        return 0
    else
        warning "PHP installation has issues, attempting alternative approach"
        return 1
    fi
}

# Check if composer is available
check_composer() {
    if ! command -v composer &> /dev/null; then
        error "Composer is not installed or not in PATH"
        exit 1
    fi
    log "Composer version: $(composer --version)"
}

# Install/Update dependencies
update_dependencies() {
    log "Installing/Updating Composer dependencies..."
    
    if ! composer install --no-dev --optimize-autoloader 2>/dev/null; then
        warning "Composer install with --no-dev failed, trying with dev dependencies"
        if ! composer install --optimize-autoloader 2>/dev/null; then
            error "Composer install failed completely"
            return 1
        fi
    fi
    
    log "Dependencies updated successfully"
}

# Clear all Laravel caches
clear_caches() {
    log "Clearing Laravel caches..."
    
    # Manual cache clearing if PHP artisan fails
    if ! php artisan config:clear 2>/dev/null; then
        warning "PHP artisan failed, clearing caches manually"
        rm -rf bootstrap/cache/*.php 2>/dev/null || true
        rm -rf storage/framework/cache/data/* 2>/dev/null || true
        rm -rf storage/framework/views/* 2>/dev/null || true
        rm -rf storage/framework/sessions/* 2>/dev/null || true
        log "Manual cache clearing completed"
        return 0
    fi
    
    php artisan cache:clear 2>/dev/null || warning "Cache clear failed"
    php artisan view:clear 2>/dev/null || warning "View clear failed"  
    php artisan route:clear 2>/dev/null || warning "Route clear failed"
    log "Caches cleared successfully"
}

# Optimize Laravel for production
optimize_production() {
    log "Optimizing Laravel for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    log "Laravel optimized for production"
}

# Run database migrations
run_migrations() {
    log "Running database migrations..."
    php artisan migrate --force
    log "Database migrations completed"
}

# Seed database with initial data
seed_database() {
    log "Seeding database..."
    php artisan db:seed --class=InitialDataSeeder --force
    log "Database seeding completed"
}

# Set proper permissions
set_permissions() {
    log "Setting proper permissions..."
    chmod -R 755 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
    log "Permissions set successfully"
}

# Backup database
backup_database() {
    local backup_file="backup_$(date +%Y%m%d_%H%M%S).sql"
    log "Creating database backup: $backup_file"
    
    DB_HOST=$(php artisan tinker --execute="echo env('DB_HOST');" 2>/dev/null | tail -n1)
    DB_DATABASE=$(php artisan tinker --execute="echo env('DB_DATABASE');" 2>/dev/null | tail -n1)
    DB_USERNAME=$(php artisan tinker --execute="echo env('DB_USERNAME');" 2>/dev/null | tail -n1)
    
    if command -v mysqldump &> /dev/null; then
        mysqldump -h "$DB_HOST" -u "$DB_USERNAME" -p "$DB_DATABASE" > "$backup_file"
        log "Database backup created: $backup_file"
    else
        warning "mysqldump not available, skipping database backup"
    fi
}

# Main automation function
main() {
    case "${1:-help}" in
        "deploy")
            log "Starting deployment process..."
            check_php
            check_composer
            backup_database
            update_dependencies
            clear_caches
            run_migrations
            seed_database
            set_permissions
            optimize_production
            log "Deployment completed successfully!"
            ;;
        "update")
            log "Starting update process..."
            check_php
            check_composer
            update_dependencies
            clear_caches
            run_migrations
            log "Update completed successfully!"
            ;;
        "cache")
            log "Managing caches..."
            check_php
            clear_caches
            optimize_production
            log "Cache management completed!"
            ;;
        "backup")
            log "Creating backup..."
            backup_database
            log "Backup completed!"
            ;;
        "permissions")
            log "Setting permissions..."
            set_permissions
            log "Permissions set!"
            ;;
        "help"|*)
            echo "Laravel Automation Script"
            echo ""
            echo "Usage: $0 [command]"
            echo ""
            echo "Commands:"
            echo "  deploy      - Full deployment (backup, update, migrate, optimize)"
            echo "  update      - Update dependencies and run migrations"
            echo "  cache       - Clear and rebuild caches"
            echo "  backup      - Create database backup"
            echo "  permissions - Set proper file permissions"
            echo "  help        - Show this help message"
            echo ""
            ;;
    esac
}

# Run the script
main "$@"