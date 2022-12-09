<?php

declare(strict_types=1);

namespace App\Src;

final class Route
{
    final public function page(): void
    {
        $action = Request::get('page') ?? 'home';
        $panel = ['admin', 'editor', 'account', 'registration'];

        if (
            !isset($_SESSION['user'])
            && in_array(Request::get('page'), $panel)
        ) {
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
                case 'registration':
                    $page = 'registration';
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