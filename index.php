<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

require ('src/Route.php');
require ('src/Request.php');
require ('src/Validation.php');
require ('src/Database.php');
require ('src/controller/AbstractController.php');
require ('src/controller/LoginController.php');
require ('src/controller/RegistrationController.php');
require ('src/model/UserTab.php');

use App\Src\Route;
use App\Src\Controller\LoginController;
use App\Src\Controller\RegistrationController;

session_start();

$login = new LoginController();
$registration = new RegistrationController();

$loadPage = new Route();
$loadPage->page();

var_dump($_SESSION['user']);