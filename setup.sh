#!/bin/bash

# Centrum Optimi Educational Foundation - Setup Script
# This script automates the setup process for the website

echo "=============================================="
echo "Centrum Optimi Educational Foundation"
echo "Website Setup Script"
echo "=============================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if running in project directory
if [ ! -f "artisan" ]; then
    echo -e "${RED}Error: Please run this script from the project root directory${NC}"
    exit 1
fi

echo -e "${YELLOW}Step 1: Installing Composer dependencies...${NC}"
composer install
if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to install Composer dependencies${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Composer dependencies installed${NC}"
echo ""

echo -e "${YELLOW}Step 2: Installing NPM dependencies...${NC}"
npm install
if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to install NPM dependencies${NC}"
    exit 1
fi
echo -e "${GREEN}✓ NPM dependencies installed${NC}"
echo ""

echo -e "${YELLOW}Step 3: Setting up environment file...${NC}"
if [ ! -f ".env" ]; then
    cp .env.example .env
    echo -e "${GREEN}✓ .env file created${NC}"
else
    echo -e "${YELLOW}! .env file already exists, skipping...${NC}"
fi
echo ""

echo -e "${YELLOW}Step 4: Generating application key...${NC}"
php artisan key:generate
echo -e "${GREEN}✓ Application key generated${NC}"
echo ""

echo -e "${YELLOW}Step 5: Creating storage link...${NC}"
php artisan storage:link
echo -e "${GREEN}✓ Storage link created${NC}"
echo ""

echo ""
echo -e "${YELLOW}=============================================="
echo "Database Setup"
echo "==============================================${NC}"
echo ""
echo "Please ensure you have:"
echo "1. Created a MySQL database named 'centrum_optimi_edu'"
echo "2. Updated the .env file with your database credentials"
echo ""
read -p "Have you completed the database setup? (y/n) " -n 1 -r
echo ""

if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo ""
    echo -e "${YELLOW}Step 6: Running migrations and seeders...${NC}"
    php artisan migrate:fresh --seed
    if [ $? -ne 0 ]; then
        echo -e "${RED}Failed to run migrations${NC}"
        echo "Please check your database configuration in .env file"
        exit 1
    fi
    echo -e "${GREEN}✓ Database migrations and seeders completed${NC}"
    echo ""
else
    echo ""
    echo -e "${YELLOW}Please complete the database setup and run:${NC}"
    echo "php artisan migrate:fresh --seed"
    echo ""
fi

echo -e "${YELLOW}Step 7: Building frontend assets...${NC}"
npm run build
if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to build assets${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Frontend assets built${NC}"
echo ""

echo ""
echo -e "${GREEN}=============================================="
echo "Setup Complete!"
echo "==============================================${NC}"
echo ""
echo "Next Steps:"
echo ""
echo "1. Start the development server:"
echo "   php artisan serve"
echo ""
echo "2. Visit: http://localhost:8000"
echo ""
echo "3. Admin Login:"
echo "   URL: http://localhost:8000/admin/login"
echo "   Email: admin@centrumoptimi.org"
echo "   Password: password"
echo ""
echo "4. Configure Payment Gateways:"
echo "   - Add Paystack API keys to .env"
echo "   - Add Flutterwave API keys to .env"
echo ""
echo "5. Setup Email (Optional):"
echo "   - Configure SMTP settings in .env"
echo ""
echo -e "${YELLOW}For detailed documentation, see PROJECT_SETUP.md${NC}"
echo ""
