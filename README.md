<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About 

Laravel Real-Time Chat Application

A real-time one-to-one chat application built with Laravel 12, Pusher, Laravel Echo, and Blade. This project demonstrates how to implement live messaging between authenticated users using event broadcasting.

Features
User Authentication (Laravel Breeze)
One-to-One Chat
Real-Time Messaging with Pusher
Chat History
Live Message Updates
User List
Event Broadcasting
Responsive Chat Interface
CSRF Protection
Tech Stack
Backend
Laravel 12
PHP 8+
MySQL
Laravel Broadcasting
Frontend
Blade Templates
JavaScript
Laravel Echo
Pusher JS
Real-Time Communication
Pusher Channels
Laravel Events
Broadcasting
Installation
Clone Repository
git clone <repository-url>
cd chat-app
Install Dependencies
composer install
npm install
Environment Configuration

Copy the environment file:

cp .env.example .env

Generate application key:

php artisan key:generate

Configure your database settings in the .env file.

Configure Pusher

Add the following credentials to your .env file:

BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
Run Migrations
php artisan migrate
Start Development Servers

Run Laravel:

php artisan serve

Run Vite:

npm run dev
Project Structure
app/
├── Events/
│   └── MessageSent.php
├── Http/
│   └── Controllers/
│       └── ChatController.php
├── Models/
│   ├── User.php
│   └── Message.php

resources/
├── views/
│   └── chat/
│       └── index.blade.php

routes/
└── web.php
Application Flow
User selects another user from the chat list.
Previous conversation is loaded from the database.
User sends a message.
Message is stored in the database.
Laravel fires a broadcast event.
Pusher receives the event.
Laravel Echo listens for the event.
The recipient receives the message instantly without page refresh.
Database Schema
Messages Table
Column	Type
id	bigint
sender_id	foreignId
receiver_id	foreignId
message	text
created_at	timestamp
updated_at	timestamp
Future Improvements
Private Channels
Online / Offline Status
Typing Indicator
Read Receipts
Message Reactions
Image Sharing
File Uploads
Group Chat
Notifications
Learning Objectives

This project was built to learn:

Laravel Broadcasting
Event-Driven Architecture
Real-Time Communication
Pusher Integration
Laravel Echo
AJAX Requests
Chat System Design
Author

Yasir Majeed

Node.js & Laravel Developer

License

This project is open-source and available under the MIT License. [MIT license](https://opensource.org/licenses/MIT).
