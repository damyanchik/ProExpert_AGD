<?php

declare(strict_types=1);

namespace App\Src\Controller\Admin;

use App\Src\Controller\AbstractController;
use App\Src\Helper\Request;
use App\Src\Model\ContentModel;
use App\Src\Router;

class ContentController extends AbstractController
{
    protected string $uri = '/content';

    protected function render(): void
    {
        $this->access(['admin', 'moderator'], '/login');

        $singleContent = $this->getContent(intval(
            Request::get('edited')
        ));

        $this->setText();

        Router::route(
            $this->uri,
            'admin/content', [
                'id' => $singleContent['id'],
                'date' => $singleContent['date'],
                'description' => $singleContent['description'],
                'text' => $singleContent['text']
        ]);
    }

    private function getContent(int $id): array
    {
        $content = new ContentModel();

        return $content->get($id)[0];
    }

    private function setText(): void
    {
        if (
            !Request::isPost('save')
            || Request::emptyPost('textEditor')
        )
            return;

        $content = new ContentModel();
        $content->update(
            intval(Request::post('save')), [
                'text' => Request::post('textEditor'),
                'date' => date('Y-m-d H:i:s')
            ]
        );

        $this->redirectToPage('/editor');
    }
}