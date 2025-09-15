# Laravel Service Booking System API

A comprehensive API-based service booking system built with Laravel, featuring customer registration, service management, and booking functionality with admin control panel.

## 🚀 Live Demo

**Live API URL:** https://api-booking-system.dnox.xyz/

**Hosted on:** AWS Linux Operating System

## 📋 Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation & Setup](#installation--setup)
- [API Documentation](#api-documentation)
- [Database Structure](#database-structure)
- [Testing](#testing)
- [Screenshots & Sample Outputs](#screenshots--sample-outputs)
- [Developer Information](#developer-information)

## 🎯 Project Overview

This Laravel-based service booking system provides a robust API for managing service bookings with separate authentication for customers and administrators. The system allows customers to browse services and make bookings, while admins can manage services and monitor all bookings.

### Core Functionality:
- **Customer Registration & Authentication**
- **Service Browsing & Booking**
- **Admin Service Management**
- **Booking Management System**
- **JWT/Token-based Security**

## ✨ Features

### Authentication System
- **User Registration & Login API** (Customer)
- **Admin Login API** (Seeded credentials)
- **JWT Token-based Authentication** using Laravel Passport
- **Role-based Access Control**

### Customer Features
- **Service Discovery** - Browse available services
- **Book Service** - Book available services
- **List Of Booked Service** - Show the Booked available services

### Admin Features
- **Service Management** - Create, update, delete services
- **Booking Overview** - Monitor all customer bookings
- **Service Status Control** - Active/Inactive services

### Data Validation
- **Comprehensive Form Validation** for all inputs
- **Date Validation** - Prevent booking on past dates
- **Business Logic Validation** - Ensure data integrity
- **Error Handling** - Proper API error responses

## 🛠 Technologies Used

- **Backend:** Laravel 12.x
- **Authentication:** Laravel Passport
- **Database:** MySQL
- **API Documentation:** Postman Collection
- **Hosting:** AWS Linux
- **Version Control:** Git

## 📦 Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL

### Step-by-Step Installation

#### 1. Clone Repository
```bash
git clone <repository-url>
cd laravel-booking-system
```

#### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install && npm run build
```

#### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Database Setup
Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### 5. Laravel Passport Installation
```bash
# Install Passport
composer require laravel/passport

# Run migrations
php artisan migrate

# Install Passport
php artisan passport:install

# Generate keys
php artisan passport:keys
```

#### 6. Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

#### 7. Start Development Server
```bash
# Start Laravel server
php artisan serve

# Server will be available at: http://localhost:8000
```

## 📚 API Documentation

### Public Endpoints

#### Customer Registration
```http
POST /api/v1/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "01300000000",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```

#### Customer/Admin Login
```http
POST /api/v1/login
Content-Type: application/json

{
    "email": "admin@example.com",
    "password": "password"
}
```

### Authenticated Customer Endpoints

#### Get Available Services
```http
GET /api/v1/customer/services
Authorization: Bearer {token}
```

#### Create Booking
```http
POST /api/v1/customer/bookings
Authorization: Bearer {token}
Content-Type: application/json

{
    "service_id": 1,
    "booking_date": "2024-12-25",
}
```

#### Get User Bookings
```http
GET /api/v1/customer/bookings
Authorization: Bearer {token}
```

### Authenticated Admin Endpoints

#### Create Service
```http
POST /api/v1/admin/services
Authorization: Bearer {admin-token}
Content-Type: application/json

{
    "name": "Web Development",
    "description": "Professional web development service",
    "price": 999.99,
    "status": 1
}
```

#### Update Service
```http
PUT /api/v1/admin/services/{id}
Authorization: Bearer {admin-token}
Content-Type: application/json

{
    "name": "AI Development",
    "description": "Professional AI development service",
    "price": 999.99,
    "status": 1
}
```

#### Delete Service
```http
DELETE /api/v1/admin/services/{id}
Authorization: Bearer {admin-token}
```

#### Get All Bookings (Admin)
```http
GET /api/v1/admin/booking-list
Authorization: Bearer {admin-token}
```

## 🗄 Database Structure

### Users Table
- `id` - Primary Key
- `name` - User's full name
- `email` - Unique email address
- `password` - Encrypted password
- `role` - Role for all user ex: 1 for Admin 2 for User
- `timestamps`

### Services Table
- `id` - Primary Key
- `name` - Service name
- `description` - Service description
- `price` - Service price (decimal)
- `status` - Service status (active/inactive)
- `timestamps`

### Service Bookings Table
- `id` - Primary Key
- `user_id` - Foreign key to users
- `service_id` - Foreign key to services
- `booking_date` - Date of booking
- `status` - Booking status
- `timestamps`

## 🧪 Testing

### Using Postman
1. Import the provided Postman collection
2. Set up environment variables:
    - `base_url`: https://api-booking-system.dnox.xyz
    - `api_url`: https://api-booking-system.dnox.xyz/api/v1/
    - `token`: https://api.postman.com/collections/23744087-aefc4adb-d211-404f-a136-b9a6d70aaa6e?access_key=PMAT-01K3PB42G9Z587MH3GKTDAHAHW

### Sample Test Flow
1. **Register Customer** → Get registration confirmation
2. **Login Customer** → Receive access token
3. **Get Services** → View available services
4. **Create Booking** → Book a service
5. **View Bookings** → See booking history

### Admin Testing
1. **Login Admin** (use seeded credentials)
2. **Create Service** → Add new service
3. **View All Bookings** → Monitor customer bookings
4. **Update/Delete Services** → Manage service catalog

## 📸 Screenshots & Sample Outputs

![Alt Text](/screenshots/Screenshot%20(22).png)

![Alt Text](/screenshots/Screenshot%20(23).png)

![Alt Text](/screenshots/Screenshot%20(24).png)

![Alt Text](/screenshots/Screenshot%20(25).png)


### Successful Registration Response
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
    }
}
```

### Services List Response
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Web Development",
            "description": "Professional web development service",
            "price": "999.99",
            "status": "active"
        },
        {
            "id": 2,
            "name": "Mobile App Development",
            "description": "iOS and Android app development",
            "price": "1499.99",
            "status": "active"
        }
    ]
}
```

### Booking Creation Response
```json
{
    "success": true,
    "message": "Booking created successfully",
    "data": {
        "id": 1,
        "user_id": 1,
        "service_id": 1,
        "booking_date": "2024-12-25",
        "status": "pending",
        "service": {
            "name": "Web Development",
            "price": "999.99"
        }
    }
}
```

## 🔧 Key Features Implemented

- ✅ **Laravel Passport Authentication**
- ✅ **Role-based Access Control** (Customer/Admin)
- ✅ **Comprehensive API Validation**
- ✅ **RESTful API Design**
- ✅ **Database Relationships** (User → Booking → Service)
- ✅ **Date Validation** (No past date bookings)
- ✅ **Database Seeders** (Sample data & admin user)
- ✅ **Error Handling** & API Responses
- ✅ **Security Best Practices**
- ✅ **Clean Code Architecture**

## 🌐 Deployment Information

- **Platform:** AWS (Amazon Web Services)
- **Operating System:** Linux
- **Web Server:** Apache
- **Database:** MySQL
- **SSL Certificate:** Enabled (HTTPS)
- **Domain:** api-booking-system.dnox.xyz

## 👨‍💻 Developer Information

### Connect with Me

- **Portfolio:** https://dnox.xyz/
- **GitHub:** https://github.com/shykat199
- **LinkedIn:** https://www.linkedin.com/in/shykay-roy/

### Featured Projects

1. **Money / Coin Investment Site (MLM Service Multi Level Referral System)** - [https://fatx.io/]
    - Laravel, API, Role Based Access, MySQL, React
   
2. **Ecommerce Site** - [https://srfmart.com/]
    - Laravel, API, Role Based Access, MySQL, React

3. **Task Management System** - [https://github.com/shykat199/Project-Management]
    - Laravel, JS, Drag drop feature like trello

4. **Real Estate Portal** - [https://rojafood.com/]
    - Laravel, MySQL, Management of property
   
5. **Ecommerce Site** - [https://ecommerce.dnox.xyz/]
    - Laravel, MySQL, Management of property, Blade 


### Technical Skills

- **Backend:** Laravel, PHP, API, Python
- **Frontend:**Vue.js, JavaScript, HTML/CSS
- **Database:** MySQL
- **DevOps:** AWS, Linux, Nginx
- **API Development:** REST, JWT Authentication

---

## 📞 Support & Contact

For any questions or support regarding this project:

- **Email:** [shykatroybdku199@gmail.com]
- **Documentation:** Available in this README

---

**Built with ❤️ using Laravel | Hosted on AWS Linux**

*This project demonstrates proficiency in Laravel development, API design, authentication systems, and cloud deployment practices.*
