# JWT Authentication Setup for Laravel

Follow these steps to integrate JWT authentication into your Laravel project.

## Step 1: Install Tymon JWT Auth Package

```bash
composer require tymon/jwt-auth
```

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
## Enabling customization through published configurations is a common practice in Laravel development.

# Step 3: Implement JWT in User Model
## Update your User model (usually located at app/Models/User.php) to implement the JWTSubject contract:

```laravel
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
