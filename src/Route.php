<?php

declare(strict_types=1);

class Route
{
    public function page(): void
    {
        $action = $_GET['page'] ?? 'home';

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
            default:
                $page = 'home';
                break;
        }

        $view = new View();
        $view->render($page);
    }
}