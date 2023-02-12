<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Model\ContentModel;
use App\Src\Router;

class AboutController extends AbstractController
{
    protected string $uri = '/about';

    protected function render(): void
    {
        Router::route($this->uri, 'about',[
            'subtitle' => $this->view()[0]['text'],
            'content' => $this->view()[1]['text']
        ]);
    }

    private function view(): array
    {
        $content = new ContentModel();

        $pageContent = $content->getByPage($content::ABOUT);

        return $pageContent;
    }
}