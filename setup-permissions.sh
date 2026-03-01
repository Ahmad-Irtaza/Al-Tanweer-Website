#!/bin/bash

# =============================================
# SQLite Permission Setup Script
# Run this script on your production server via SSH
# =============================================

echo "=========================================="
echo "AL TANWEER - SQLite Permission Setup"
echo "=========================================="
echo ""

# Set the correct path (change this if needed)
SITE_ROOT="/home/YOUR_USERNAME/public_html"
DATA_DIR="$SITE_ROOT/data"
DB_FILE="$DATA_DIR/altanweer.sqlite"

echo "Site Root: $SITE_ROOT"
echo "Data Directory: $DATA_DIR"
echo ""

# Check if we're in the right directory
if [ ! -f "$SITE_ROOT/index.php" ]; then
    echo "❌ Error: Cannot find index.php in $SITE_ROOT"
    echo "Please edit this script and set the correct SITE_ROOT path"
    exit 1
fi

echo "✅ Found website files"
echo ""

# Create data directory if it doesn't exist
if [ ! -d "$DATA_DIR" ]; then
    echo "📁 Creating data directory..."
    mkdir -p "$DATA_DIR"
    echo "✅ Data directory created"
else
    echo "✅ Data directory exists"
fi

# Set directory permissions
echo ""
echo "🔧 Setting directory permissions..."
chmod 755 "$DATA_DIR"
echo "✅ Data directory permissions: 755"

# Set database file permissions if it exists
if [ -f "$DB_FILE" ]; then
    echo "🔧 Setting database file permissions..."
    chmod 644 "$DB_FILE"
    echo "✅ Database file permissions: 644"
else
    echo "ℹ️  Database file doesn't exist yet (will be created automatically)"
fi

# Set ownership (only if running as root/sudo)
if [ "$EUID" -eq 0 ]; then
    echo ""
    echo "🔧 Setting ownership..."
    echo "Enter your cPanel username (or press Enter to skip):"
    read -r CPANEL_USER
    
    if [ -n "$CPANEL_USER" ]; then
        chown -R "$CPANEL_USER:$CPANEL_USER" "$DATA_DIR"
        echo "✅ Ownership set to: $CPANEL_USER"
    fi
fi

# Check permissions
echo ""
echo "=========================================="
echo "Permission Check:"
echo "=========================================="
ls -la "$DATA_DIR"

echo ""
echo "=========================================="
echo "Setup Complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Visit your website to test: https://altanweerdoors.com"
echo "2. If you still see errors, check error logs"
echo "3. Make sure SQLite PHP extension is installed"
echo ""
