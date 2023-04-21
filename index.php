<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

spl_autoload_register(function (string $namespaceClass) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $namespaceClass);
    $path = "$path.php";
    require($path);
});

use App\Src\Controller\AboutController;
use App\Src\Controller\ContactController;
use App\Src\Controller\CoverageController;
use App\Src\Controller\HomeController;
use App\Src\Controller\LoginController;

use App\Src\Controller\Admin\AccountController;
use App\Src\Controller\Admin\AdminController;
use App\Src\Controller\Admin\EditorController;
use App\Src\Controller\Admin\RegistrationController;
use App\Src\Controller\Admin\ContentController;

session_start();

$login = new LoginController();
$home = new HomeController();
$contact = new ContactController();
$about = new AboutController();
$coverage = new CoverageController();

$account = new AccountController();
$admin = new AdminController();
$editor = new EditorController();
$registration = new RegistrationController();
$content = new ContentController();
