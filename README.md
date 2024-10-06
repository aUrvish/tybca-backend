# Online Exam System

- Developed an online exam system with a modern, responsive frontend using Vue.js and Tailwind CSS for seamless user experience. Implemented state management with Pinia, interactive features with Vue-Draggable, pagination with Vue-Awesome-Paginate, and notifications using Vue3-Toastify.
- Backend built with Laravel, utilizing core features such as Eloquent ORM and Websockets for real-time functionality. Emphasized clear, maintainable code structure to ensure scalability and ease of collaboration with other developers.


# Project Setup

## Step 1 : Composer setup

⚠️ ***Note:*** If you already have XAMPP and Composer installed, you can skip this step.

- If you don't have Composer installed on your local system, download it from [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe) link and install it to manage Laravel package installations.

- Also XAMPP server install from here [Xampp download](https://www.apachefriends.org/download.html)

After cloning the project and installing Composer, navigate to the root directory of the project and run the command.

```sh
composer install
```

## Step 2 : .env setup

To copy the `.env.example` file to a new `.env` file, you can use the following command in your terminal:

### For Linux/macOS:
```bash
cp .env.example .env
```

### For Windows:
```bash
copy .env.example .env
```

This command creates a new `.env` file by copying the contents of the `.env.example` file.


### Genrate application encryption key


   ```bash
   php artisan key:generate
   ```

### Setup Mail configuration
Update the following configuration parameters `.env`

   ```bash
   MAIL_DRIVER=smtp
   MAIL_HOST=smtp.example.com  # Replace with your mail server
   MAIL_PORT=587                # Common port for TLS
   MAIL_USERNAME=your_email@example.com  # Your email address
   MAIL_PASSWORD=your_password  # Your email password or API key
   MAIL_ENCRYPTION=tls          # Use tls or ssl depending on your provider
   MAIL_FROM_ADDRESS=your_email@example.com  # The "from" email address
   MAIL_FROM_NAME="Your Name"  # The "from" name
   ```

⚠️ ***Note***: If you're using Mailtrap, follow these commands:
To configure Mailtrap in Laravel, follow these steps:

1. **Create a Mailtrap Account**: If you don’t have a Mailtrap account, sign up at [Mailtrap](https://mailtrap.io).

2. **Get Mailtrap SMTP Credentials**: After logging in, create a new inbox (if you haven’t already), and note the SMTP credentials provided. (select Laravel 9+ in Code Samples tab)

3. **Update Your `.env` File**: Open the `.env` file in your Laravel project and add the following configuration:

   ```plaintext
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_mailtrap_username
   MAIL_PASSWORD=your_mailtrap_password
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS=noreply@example.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

   Replace `your_mailtrap_username` and `your_mailtrap_password` with the actual credentials from your Mailtrap inbox.


## Step 3 : Migrate database
⚠️ ***Note:*** First, ensure that you connect to phpMyAdmin or any other MySQL server, and configure the connection in the `.env` file.

   ```bash
   php artisan migrate
   ```

After this, run the seed command to populate the database with the admin record and the default course record.

⚠️ ***Note:*** You can modify the records as needed by changing the details in `app/database/seeders/AdminSeeder.php` and `app/database/seeders/DefaultCourseSeeder.php`.

   ```bash
   php artisan db:seed
   ```

## Step 4 : Websockets configuration
Install the Pusher PHP server if your package does not already include it by running
   ```bash
   composer require pusher/pusher-php-server
   ```

After that, update the WebSocket configuration in the `.env` file by changing
   ```bash
   BROADCAST_DRIVER=pusher
   ```

Also update value
   ```bash
   PUSHER_APP_ID=123456
   PUSHER_APP_KEY=ABCDEFG
   PUSHER_APP_SECRET=ABCDEFG
   PUSHER_HOST=127.0.0.1
   PUSHER_PORT=6001
   PUSHER_SCHEME=http
   PUSHER_APP_CLUSTER=mt1
   ```

⚠️ ***Note:*** If you're using a secure web server, set the value of `PUSHER_SCHEME` in the `.env` file to `https` instead of `http`.


## Step 5 : Run project

First, you need to run the optimize command to enhance performance and clear the cache.

   ```bash
   php artisan optimize
   ```

The following command is used to start the project. Make sure to run all commands in a different terminal, as they always run in that environment.

1. run `serve` command to start a development server for your application.

   ```bash
   php artisan serve
   ```

2. run `queue:work` command to process queued jobs in the background.

   ```bash
   php artisan queue:work
   ```

3. run `websockets:serve` command to process queued jobs in the background.

   ```bash
   php artisan websockets:serve
   ```