<?php

namespace App\Controllers;

use Core\View;

class PageController
{
    public function index(): void
    {
        // On mais des donnée en dur
        $view_data = [
            'title_tag' => 'mon site',
            'list_title' => 'Bienvenu',
            'toys_list' => [
                'jouet 1',
                'jouet 2'
            ]
        ];

        $view = new View('Page/home');
        $view->titre = 'Mon site MVC';
        $view->render($view_data);
    }
}