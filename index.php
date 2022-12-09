<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

spl_autoload_register(function (string $namespaceClass) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $namespaceClass);
    $path = "$path.php";
    require_once($path);
});

use App\Src\Route;
use App\Src\Controller\LoginController;
use App\Src\Controller\RegistrationController;

session_start();

$login = new LoginController();
$registration = new RegistrationController();

$loadPage = new Route();
$loadPage->page();
