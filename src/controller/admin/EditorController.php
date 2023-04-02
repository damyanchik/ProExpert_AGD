<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Builder\AdditionBuilder;
use App\Src\Builder\ListBuilder;
use App\Src\Controller\AbstractController;
use App\Src\Model\ContentModel;
use App\Src\Router;

class EditorController extends AbstractController
{
    protected string $uri = '/editor';

    protected function render(): void
    {
        $this->access(['admin', 'moderator'], '/login');

        $panel = AdditionBuilder::create(
            'additions\panel', [
            'editorActive' => 'active',
            'user' => $_SESSION['user']
        ]);

        Router::route(
            $this->uri,
            'admin/editor', [
            'panel' => $panel,
            'list' => $this->listContent()
        ]);
    }

    private function listContent(): string
    {
        $content = new ContentModel();
        $list = $content->get();

        $list = ListBuilder::modify(
            $list,
            ['page', 'page', 'page', 'page'],
            ['HOME', 'ABOUT', 'COVERAGE', 'CONTACT'],
            ['HOME' => 1, 'ABOUT' => 2, 'COVERAGE' => 3, 'CONTACT' => 4]
        );

        return ListBuilder::create('lists\editor\contents', $list);
    }
}