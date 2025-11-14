# 🚀 Fly.io Deployment Guide for Astroway Astrology App

This Laravel-based astrology application is optimized for deployment on Fly.io with complete admin dashboard, payment gateways, and astrology features.

## 📋 Prerequisites

1. **Fly.io Account**: Sign up at [fly.io](https://fly.io)
2. **Flyctl CLI**: Install the Fly.io CLI
   ```bash
   curl -L https://fly.io/install.sh | sh
   ```
3. **Docker**: Ensure Docker is running locally

## 🛠️ Quick Deployment

### 1. Login to Fly.io
```bash
flyctl auth login
```

### 2. Deploy Application
```bash
# Make deployment script executable (Linux/Mac)
chmod +x deploy-fly.sh
./deploy-fly.sh

# Or deploy manually
flyctl deploy --local-only
```

### 3. Set Up Database (Required)
```bash
# Create PostgreSQL database
flyctl postgres create --name jyotishbaje-db

# Attach database to app
flyctl postgres attach --app jyotishbaje jyotishbaje-db
```

### 4. Configure Environment Secrets
```bash
# Required secrets
flyctl secrets set \
  RAZORPAY_KEY=your_razorpay_key \
  RAZORPAY_SECRET=your_razorpay_secret \
  STRIPE_KEY=your_stripe_key \
  STRIPE_SECRET=your_stripe_secret \
  FIREBASE_PROJECT_ID=your_firebase_project \
  FCM_SERVER_KEY=your_fcm_key \
  AGORA_APP_ID=your_agora_id \
  AGORA_APP_CERTIFICATE=your_agora_cert
```

## 🔐 Default Admin Access

- **URL**: `https://jyotishbaje.fly.dev/login`
- **Email**: `admin@admin.com`
- **Password**: `admin123`

## 📁 Project Structure

```
├── fly.toml              # Fly.io configuration
├── Dockerfile            # Container configuration
├── start-fly.sh         # Startup script
├── nginx-fly.conf       # Nginx configuration
├── supervisord-fly.conf # Process management
├── deploy-fly.sh        # Deployment script
└── .env.fly            # Environment template
```

## 🎯 Features Included

### 🔮 Astrology Features
- **Kundli Generation**: Complete birth chart calculations
- **Horoscope**: Daily, weekly, monthly predictions
- **Matching**: Compatibility analysis
- **Panchang**: Vedic calendar and timing

### 💰 Payment Gateways
- **Razorpay**: Indian payments
- **Stripe**: International payments
- **PayPal**: Global payments
- **Wallet System**: In-app currency

### 📱 Communication
- **Live Chat**: Real-time astrologer consultation
- **Video Calls**: Agora-powered video sessions
- **Push Notifications**: Firebase messaging
- **SMS Integration**: OTP and notifications

### 👥 User Management
- **Multi-role System**: Users, Astrologers, Admin
- **Profile Management**: Complete user profiles
- **Document Verification**: Astrologer credentials
- **Review System**: Ratings and feedback

## ⚙️ Configuration

### Database Configuration
The app automatically configures database connection using Fly.io's `DATABASE_URL` environment variable.

### Redis Configuration (Optional)
```bash
# Add Redis for better performance
flyctl redis create --name jyotishbaje-redis
flyctl redis attach --app jyotishbaje jyotishbaje-redis
```

### File Storage
- **Local Storage**: Default for development
- **AWS S3**: Configure for production file uploads
- **CDN**: Recommended for images and assets

## 🔧 Environment Variables

### Required
- `DATABASE_URL`: Automatically set by Fly.io
- `APP_KEY`: Laravel application key
- `RAZORPAY_KEY/SECRET`: Payment processing
- `STRIPE_KEY/SECRET`: International payments

### Optional
- `REDIS_URL`: For caching and sessions
- `MAIL_*`: Email configuration
- `AWS_*`: File storage configuration
- `PUSHER_*`: Real-time notifications

## 📊 Monitoring & Scaling

### Check Application Status
```bash
flyctl status
flyctl logs
flyctl metrics
```

### Scale Application
```bash
# Scale to 2 instances
flyctl scale count 2

# Scale memory
flyctl scale memory 1024
```

### Health Monitoring
- Health check endpoint: `/health`
- Automatic restart on failures
- Performance metrics available

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Failed**
   ```bash
   flyctl postgres attach --app jyotishbaje jyotishbaje-db
   ```

2. **Asset Build Errors**
   - Fallback assets are automatically created
   - Check logs: `flyctl logs`

3. **Memory Issues**
   ```bash
   flyctl scale memory 512
   ```

4. **Slow Performance**
   ```bash
   # Add Redis
   flyctl redis create --name jyotishbaje-redis
   flyctl redis attach --app jyotishbaje jyotishbaje-redis
   ```

### Debug Commands
```bash
# View application logs
flyctl logs --tail

# Connect to app instance
flyctl ssh console

# Check database connection
flyctl postgres connect --app jyotishbaje-db

# View secrets
flyctl secrets list
```

## 🔄 Updates & Maintenance

### Deploy Updates
```bash
git add .
git commit -m "Update application"
flyctl deploy --local-only
```

### Database Migrations
```bash
# Run in app console
flyctl ssh console
php artisan migrate --force
```

### Clear Cache
```bash
flyctl ssh console
php artisan cache:clear
php artisan config:clear
```

## 📞 Support

### Application Features
- Admin Dashboard: Complete management interface
- Payment Processing: Multiple gateway support
- Astrology Calculations: Accurate Vedic computations
- Multi-language: Support for regional languages

### Technical Stack
- **Backend**: Laravel 10, PHP 8.2
- **Database**: MySQL/PostgreSQL
- **Cache**: Redis (optional)
- **Frontend**: Blade templates, Vite
- **Infrastructure**: Fly.io containers

## 🌟 Production Checklist

- [ ] Database attached and migrated
- [ ] Payment gateway credentials configured
- [ ] Firebase notifications set up
- [ ] Email service configured
- [ ] SSL certificate active (automatic on Fly.io)
- [ ] Admin user created
- [ ] Backup strategy implemented
- [ ] Monitoring configured

## 📈 Performance Optimization

### Recommended Settings
```bash
# Set optimal scaling
flyctl scale count 2
flyctl scale memory 512

# Add Redis for caching
flyctl redis create --name jyotishbaje-redis

# Configure CDN for assets
# Use AWS CloudFront or similar
```

Your Astroway astrology application is now ready to serve users worldwide on Fly.io! 🌟