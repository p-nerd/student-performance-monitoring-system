<?php

require __DIR__ . "/../vendor/autoload.php";

use App\Services\PDF;
use Core\Image;

PDF::createDir();
Image::createDir();
