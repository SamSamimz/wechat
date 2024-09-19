# Wechat

A real-time chat application built with Laravel, Inertia.js, and Vue.js. This application uses Laravel Reverb for real-time messaging, allowing users to send and receive messages instantly and play a notification sound also.

## Installation

### Clone the Repository
```bash
git clone https://github.com/SamSamimz/wechat.git
cd wechat
```
### Generate application key
```bash
php artisan key:generate 
```

### .env 
```bash
cp .env.example .env

```

### Install composer
```bash
composer install 
```

### npm 
```bash
npm install && npn run dev 
```

### Database 
```bash
php artisan migrate:fresh --seed 
```

## Start the reverb

```bash
php artisan reverb:start
or,
php artisan reverb:start --debug
```

### Serve on local
```bash
php artisan serve
```
