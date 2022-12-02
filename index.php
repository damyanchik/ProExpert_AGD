<?php
//error_reporting(0)
declare(strict_types=1);

namespace App;

require ('src/Route.php');

use App\Src\Route;

$loadPage = new Route();
$loadPage->page();
