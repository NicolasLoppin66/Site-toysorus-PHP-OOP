<?php

namespace Core;

use App\Controllers\AuthController;

class View
{
    // Definir le chemin absolut du dossier View
    // On utilise la constante d'index.php
    public const PATH_VIEW = PATH_ROOT . 'Views' . DS;
    public const PATH_PARTIALS = self::PATH_VIEW . '_templates' . DS;
    public string $titre = 'Titre par défauts';

    public function __construct(
        private string $name,
        private bool $is_complete = false
    ) {}

    private function getRequirePath(): string
    {
        $arr_name = explode('/', $this->name);
        $category = $arr_name[0];
        $name = $arr_name[1];
        $name_prefix = $this->is_complete ? '' : '_';

        return self::PATH_VIEW . $category . DS . $name_prefix . $name . '.html.php';
    }

    // On crée la méthode de rendu
    public function render(?array $view_data = []): void
    {
        // On vas checker si un utilisateur est en session
        $auth = AuthController::class;

        if (!empty($view_data))
            extract($view_data);
        ob_start();

        if (!$this->is_complete) {
            require_once self::PATH_PARTIALS . '_top.html.php';
        }

        require_once $this->getRequirePath();
        
        if (!$this->is_complete) {
            require_once self::PATH_PARTIALS . '_bottom.html.php';
        }

        ob_end_flush();
    }
}