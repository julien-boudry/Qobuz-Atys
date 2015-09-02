<?php

use AtysQobuz\Atys;

require_once '../lib/Atys.php';

Atys::$Login = "julien.boudry@gmail.com";
Atys::setPasswordMD5(hash('md5',''));
# Atys::createToken();

echo Atys::$_UserToken;

var_dump(Atys::request("purchase/getUserPurchases"));