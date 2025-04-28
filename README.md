# 🚀 Google 2FA Laravel

**Google 2FA Laravel** is a Laravel application to easily integrate Google Two-Factor Authentication (2FA) into application, enhancing the security of user accounts.

## ✨ Features

- 🔐 **Easy 2FA Integration**: Quickly set up Google 2FA for your Laravel application.
- 📱 **Google Authenticator Support**: Users can use the Google Authenticator app for secure login.
- ⚡ **Real-Time Authentication**: Ensure users can authenticate via time-sensitive codes.

## 🛠️ Installation

To set up the project locally:

1. **Clone the Repository**
   ```bash
   git clone https://github.com/bryanmoreira/google-2fa-laravel.git
   cd google-2fa-laravel
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Set Up Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit the `.env` file with the correct settings for your application.

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Serve the Application**
   ```bash
   php artisan serve
   ```

   Visit [http://localhost:8000](http://localhost:8000) in your browser.

## 📄 Usage

1. 🔐 **Enable Google 2FA for Users**  
   Implement Google 2FA for your users, allowing them to set up the Google Authenticator app.

2. 📲 **Authenticate with Google Authenticator**  
   Users will be required to input a code from their Google Authenticator app for secure login.

## 🧰 Tech Stack

- 🌐 PHP (Backend Language)
- 🧠 Laravel (PHP Framework)
- 🔑 Google 2FA (Two-Factor Authentication)
