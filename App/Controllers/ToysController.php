<?php

namespace App\Controllers;

use App\AppRepoManager;
use Core\View;

class ToysController extends Controller
{
    public function index(): void
    {
        $view_data = [
            'title_tag' => 'Mon site',
            'H1_tag' => 'Nos jouets',
            'toys' => AppRepoManager::getRm()->getToyRepo()->findAll()
        ];

        $view = new View('toys/list');
        $view->titre = 'Tous nos jouets';
        $view->render($view_data);
    }

    public function toysById(int $id): void
    {
        $toy_result = AppRepoManager::getRm()->getToyRepo()->findByIdWithBrand($id);

        $view_data = [
            'title_tag' => $toy_result->name,
            'toys' => $toy_result
        ];

        $view = new View('toys/detail');
        $view->titre = $toy_result->name;
        $view->render($view_data);
    }

    public function toysByBrandId(int $id): void
    {
        $view_data = [
            'title_tag' => 'Mon site',
            'H1_tag' => 'Nos jouets par marque',
            'toys' => AppRepoManager::getRm()->getToyRepo()->findAllByBrand($id)
        ];

        $view = new View('toys/list');
        $view->titre = 'Jouet par marque';
        $view->render($view_data);
    }
}