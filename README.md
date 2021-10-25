<p align="center"><img src="https://sloth-lab.com/ss-02.png" width="300"></p>

# Sloth Utilities
This package gives your Laravel projects some utilities that you might need for production. It's so simple to use, once it's installed, your project will be at your full controll when delivering it to your client.

It's a package meant for freelancers that have issues with scammers and none paying clients, or to also facilitate the deployment and updates without having server access nor setting up github actions.

**Top features:**

- Kill Switch that "kills the project" by putting it in maintenance mode and hiding tthe routes
- Reviving the project
- Project update with git pull and composer install and migration
- Clear cache and optimize the app
- Composer dump-autoload
- Launch seed (or maybe you want to see an admin user ;) )
- Refresh migration
- Many more to come...

## Getting Started
### 1. Install

Run the following command:

```
composer require slothlabdotcom/sloth-utilities
```
after the package is installed run the following :
```
php artisan sloth:install
```

### 2. Register (for Laravel < 5.5)

Register the service provider in ``config/app.php``

```php
Slothlabdotcom\SlothUtilities\SlothUtilitiesServiceProvider::class,
```

### 3. Configure

Default password can be modified on `config/ziplock.php`


## Usage
Keep in mind `slothadmin` is the default password for the utilities and can be changed in `config/ziplock.php`, while doing that do not forget to clear configs by running : 
```
php artisan config:clear
```

### Kill the Project

By visiting the link below you project will go into maintenance mode and hides the `web.php` route by backing it up into `config/lock.php` so make sure you don't accidently delete it unless you are very sure.
```
http://localhost:8000/SlothLab/Kill/slothadmin
```
change ``localhost:8000`` with your app domain and ``slothadmin`` with your password

### Revive the Project
to revert the process first go to  
```
http://localhost:8000/slothadmin
```
where ``slothadmin`` with your password to go into the secret mode while the application is in maintenaince mode then 
```
http://localhost:8000/SlothLab/Revive/slothadmin
```

### Utilities
to access your utilities you just have to visit 
```
http://localhost:8000/SlothLab/git/slothadmin
```
there you can hover on each button to see what it does exactly


# Screenshots

<p align="center"><img src="https://sloth-lab.com/Screenshot_3.png" width="300"></p>
<p align="center"><img src="https://sloth-lab.com/Screenshot_2.png" width="300"></p>



## License

The Sloth Utilities is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
