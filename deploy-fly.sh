#!/bin/bash

# Fly.io Deployment Script for Laravel Astrology Application
echo "🚀 Deploying Astroway Astrology App to Fly.io..."

# Check if flyctl is installed
if ! command -v flyctl &> /dev/null; then
    echo "❌ flyctl CLI not found. Please install it first:"
    echo "   curl -L https://fly.io/install.sh | sh"
    exit 1
fi

# Check if user is logged in to Fly.io
if ! flyctl auth whoami &> /dev/null; then
    echo "❌ Not logged in to Fly.io. Please run: flyctl auth login"
    exit 1
fi

echo "✅ Flyctl CLI found and authenticated"

# Check if fly.toml exists
if [ ! -f "fly.toml" ]; then
    echo "❌ fly.toml not found. Run this script from the project root."
    exit 1
fi

echo "📦 Preparing deployment..."

# Build and deploy
echo "🏗️ Building and deploying application..."
flyctl deploy --local-only

echo "🔍 Checking deployment status..."
flyctl status

echo "🔧 Setting up database (if needed)..."
echo "   Run these commands manually if you need a database:"
echo "   flyctl postgres create --name jyotishbaje-db"
echo "   flyctl postgres attach --app jyotishbaje jyotishbaje-db"

echo "🔑 Setting environment secrets..."
echo "   Set your secrets with:"
echo "   flyctl secrets set DATABASE_URL=mysql://user:pass@host:port/dbname"
echo "   flyctl secrets set RAZORPAY_KEY=your_key"
echo "   flyctl secrets set STRIPE_SECRET=your_secret"

echo "🎉 Deployment complete!"
echo "📱 Your app should be available at: https://jyotishbaje.fly.dev"
echo "🔐 Admin login: admin@admin.com / admin123"

echo ""
echo "📋 Next steps:"
echo "1. Set up database: flyctl postgres create --name jyotishbaje-db"
echo "2. Attach database: flyctl postgres attach --app jyotishbaje jyotishbaje-db"
echo "3. Set payment secrets: flyctl secrets set RAZORPAY_KEY=xxx STRIPE_SECRET=xxx"
echo "4. Monitor logs: flyctl logs"
echo "5. Scale if needed: flyctl scale count 2"