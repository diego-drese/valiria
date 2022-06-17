# Valíria Auth ACL
Valíria is a Laravel package to authentication and authorization package.

The middleware `val.acl` check if auth user is authorized to access the route and he is authorized when has permission with 
the same name of the route within any role he has

## The name Valíria is based on Game Of Thrones
Only the greatest smiths can reforge swords from existing Valirian steel, and the secret of creating such an alloy was apparently lost with Valíria, making these remaining weapons highly prized and extremely rare. Valirian steel blades in Westeros are precious relics of noble houses, each with its own name and history.

## Install
* Install packaqe with composer `composer require diego-drese/valiria`
* Publish seeder `php artisan vendor:publish --force --tag auth-seeds`
* Add `val.acl` on routes with that you wish check permissions
* Run php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
* Run php artisan migrate
* Run `php artisan db:seed --class=PermissionsTableSeeder` to populate permissions table


## Use
* Add Sanctum's middleware to your api middleware group within your app/Http/Kernel.php file:    
cUrl
```bash
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

'api' => [
    EnsureFrontendRequestsAreStateful::class,
    'throttle:60,1',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```
* Add trait in  User model, check if model User exists in app\Model\User.php
```bash
use Laravel\Sanctum\HasApiTokens;
use Valiria\Traits\ValiriaUser;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, ValiriaUser;
}
```
## License

The Valiria package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
