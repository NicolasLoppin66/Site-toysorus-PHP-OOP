<?php

namespace App;

use App\Controllers\AdminController;
use MiladRahimi\PhpRouter\Router;
use App\Controllers\AuthController;
use App\Controllers\PageController;
use App\Controllers\ToysController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;

class App implements DatabaseConfigInterface
{
    // On déclare les constante
    private const DB_HOST = 'database';
    private const DB_NAME = 'lamp';
    private const DB_USER = 'lamp';
    private const DB_PASS = 'lamp';

    private static ?self$instance = null;

    // methode appeller au démarrage de l'appli (dans index.php)
    public static function getApp()
    {
        if (is_null(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    // On gere la partie router
    private Router $router;
    public function getRouter(): Router
    {
        return $this->router;
    }

    public function __construct()
    {
        $this->router = Router::create();
    }

    // On a 3 methode a déclarer
    // 1er : methode start: activation du router
    public function start()
    {
        session_start();
        $this->registerRoute();
        $this->startRouter();
    }

    // 2eme : Methode qui enregistre les routes
    public function registerRoute()
    {
        $auth = AuthController::class;

        // Déclaration des pattern pour tester les valeur des arguments
        $this->router->pattern('id', '[1-9]\d*');
        $this->router->pattern('slug', '(\d+-)?[a-z]+(-[a-z\d]+)*');

        // on enregistre la route des jouet
        $this->router->get('/', [ToysController::class, 'index']);
        $this->router->get('/jouet/{id}', [ToysController::class, 'toysById']);
        $this->router->get('/brand/{id}', [ToysController::class, 'toysByBrandId']);

        // on enregistre la route de connection
        $this->router->get('/connexion', [AuthController::class, 'index']);
        $this->router->post('/login', [AuthController::class, 'login']);
        $this->router->get('/logout', [AuthController::class, 'logout']);

        if ($auth::isAdmin()) {
            $this->router->get('/admin', [AdminController::class, 'index']);
            $this->router->get('/admin/update_user/{id}', [AdminController::class, 'updateUser']);
            $this->router->post('/admin/update', [AdminController::class, 'updateU']);
        }
    }

    // 3eme : Methode qui démarre le router
    public function startRouter()
    {
        try {
            $this->router->dispatch();
        } catch (RouteNotFoundException | InvalidCallableException $e) {
            echo $e;
        }
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return self::DB_HOST;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::DB_NAME;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return self::DB_USER;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return self::DB_PASS;
    }
}