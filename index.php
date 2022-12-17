<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

spl_autoload_register(function (string $namespaceClass) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $namespaceClass);
    $path = "$path.php";
    require($path);
});

use App\Src\Router;
use App\Src\Controller\AboutController;
use App\Src\Controller\ContactController;
use App\Src\Controller\CoverageController;
use App\Src\Controller\HomeController;
use App\Src\Controller\LoginController;
use App\Src\Controller\RegistrationController;

session_start();

$registration = new RegistrationController();
$login = new LoginController();
$home = new HomeController();
$contact = new ContactController();
$about = new AboutController();
$admin = new CoverageController();

Router::route('/admin', 'admin');

