<p align="center">
  <img src="Atys.png" alt="Atys Logo"><br>
  <em>We all prefer him as a pine!</em>
</p>   

ATYS - PHP tools for Qobuz library
===========================

```php
use AtysQobuz\Atys ;

Atys::$AppID = '100000000'; // Optional
Atys::setAPPSecret('XXX'); // If you have one.

Atys::$CacheDirectory = '/home/julien/QobuzCache'; // Active cache functionality
Atys::setCacheLength(7200); // Two Hours

var_dump(Atys::request('album/get', ['album_id' => '3760156050089'])); // Album representation is under AtysQobuz\Entity\Album Class. Other method can return a PHP array translation from Json.

Atys::$Login = "myLogin";
Atys::setPasswordMD5(hash('md5','yourPassword'));

Atys::request("purchase/getUserPurchases");
```