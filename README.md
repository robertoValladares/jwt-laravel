# Awesome Laravel JWT Authentication

Welcome to the world of secure and efficient authentication with JSON Web Tokens (JWT) in your Laravel project! 🚀

In this repository, we've curated a comprehensive guide to seamlessly integrate JWT authentication into your Laravel application. Whether you're building a robust API or enhancing your web application's security, these step-by-step instructions will empower you to implement JWT authentication with ease.

🔐 **Secure your application**: Learn how to install and configure the powerful Tymon JWT Auth package, ensuring a robust security layer for your Laravel project.

🛠️ **Customize your authentication process**: Tailor the authentication flow by implementing JWT in your User model, defining routes, and registering middleware for a personalized and efficient login experience.

🔄 **Token management made easy**: Explore how to refresh tokens, handle logout functionality, and manage token expiration effortlessly.

🗝️ **Generate and manage secret keys**: Ensure the security of your application by understanding the process of generating JWT secret keys using Artisan commands.

🌐 **API-friendly authentication**: Configure your Laravel application to authenticate API requests seamlessly, providing a smooth experience for your users.

🔧 **Fine-tune password reset**: Delve into the configuration of password reset settings to enhance the user-friendly aspects of your authentication process.

Feel free to dive into the steps, copy the provided code snippets, and elevate your Laravel project's authentication to the next level. Let's make your application more secure, user-friendly, and ready for the challenges of modern web development!

**Note:** All the code and instructions mentioned in this guide are available in this repository and are fully functional for Laravel 10. You can find everything you need to implement JWT authentication in your Laravel project.

Happy coding! 🚀🔒
# JWT Authentication Setup for Laravel

Follow these steps to integrate JWT authentication into your Laravel project.

## Step 1: Install Tymon JWT Auth Package
```bash
composer require tymon/jwt-auth
```
## Step 2: Publish Package Configuration
```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

## Step 3: Implement JWT in User Model
## Update your User model (usually located at app/Models/User.php) to implement the JWTSubject contract:

```php
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // ...

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
```
## Step 4: Traits and Methods in AuthController
Update your AuthController to include necessary traits and methods:

```php
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers, JWTAuthenticatesUsers;

    // ...
}

```
## Step 5: Define Authentication Routes
In your routes file (usually web.php or api.php), define routes for authentication:

```php
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

```

## Step 6: Middleware Registration
Ensure that the jwt.auth middleware is registered in the 'api' middleware group in app/Http/Kernel.php:

```php
'api' => [
    // ...
    \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
],
```

## Step 7: Generate JWT Secret Key
Run the Artisan command to generate a JWT secret key:
```bash
php artisan jwt:secret
```
## Step 8: Customize Login Process
In your User model, customize the login process by specifying different fields:

```php
public function getAuthIdentifierName()
{
    return 'email'; // Change 'email' to the desired authentication field
}

public function getAuthPassword()
{
    return $this->password;
}
```
## Step 9: Verify Authentication Settings
Check and configure the authentication settings in config/auth.php:

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Adjust based on your User model location and name
    ],
],

```

## Step 10: Configure Password Reset
Configure the authentication field in config/auth.php under the 'passwords.users.provider':

```php
'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
    ],
],
```
