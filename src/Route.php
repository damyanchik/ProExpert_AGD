<?php

declare(strict_types=1);

namespace App\Src;

require ('src/View.php');

use App\Src\View;

final class Route
{
    final public function page(): void
    {
        $action = $_GET['page'] ?? 'home';
        $panel = ['admin', 'editor', 'account'];

        if (!isset($_SESSION['user']) && in_array($_GET['page'], $panel)) {
            $page = 'login';
        } else {
            switch ($action) {
                case 'about':
                    $page = 'about';
                    break;
                case 'coverage':
                    $page = 'coverage';
                    break;
                case 'contact':
                    $page = 'contact';
                    break;
                case 'admin':
                    $page = 'admin';
                    break;
                case 'editor':
                    $page = 'editor';
                    break;
                case 'account':
                    $page = 'account';
                    break;
                default:
                    $page = 'home';
                    break;
            }
        }

        $view = new View();
        $view->render($page);
    }
}