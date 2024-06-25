<?php


require __DIR__ .  "/../boot.php";

use Core\Auth;

Auth::logout();

redirect("/");
