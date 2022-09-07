## Installation & Configuration

- Installation
  ```
  composer create-project globalxtreme/laravel-backend-service project
  ```
- Configuration system in **config/base.conf.php**
  ```php
   return [

        // Base url for service
        'prefix' => 'api'

   ];
  ```
- Generate Algorithm file
  ```
  // Generate basic algorithm
  php artisan make:algorithm ExampleAlgorithm
  
  // Generate algorithm without abstract class
  php artisan make:algorithm ExampleAlgorithm -w
  ```
