## Installation & Configuration

- Configuration system in **config/base.conf.php**
  ```php
   return [

        // Base url for service
        'prefix' => 'api'

   ];
  ```
- Generate Algorithm file
  ```php
  // Generate basic algorithm
  php artisan make:algorithm ExampleAlgorithm
  
  // Generate algorithm without abstract class
  php artisan make:algorithm ExampleAlgorithm -w
  ```
