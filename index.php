<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

require_once('src/model/UserTab.php');

spl_autoload_register(function (string $namespaceClass) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $namespaceClass);
    $path = "$path.php";
    require($path);
});

use App\Src\Router;
use App\Src\Controller\LoginController;
use App\Src\Controller\RegistrationController;

session_start();

$login = new LoginController();
$registration = new RegistrationController();

Router::route('/', 'home');
Router::route('/contact', 'contact');
Router::route('/about', 'about');
Router::route('/admin', 'admin');
Router::route('/coverage', 'coverage');
