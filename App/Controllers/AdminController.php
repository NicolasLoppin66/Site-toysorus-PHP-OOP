<?php

namespace App\Controllers;

use Core\Form\FormResult;
use Core\View;
use App\AppRepoManager;
use App\Session;
use Core\Form\FormError;
use Laminas\Diactoros\ServerRequest;

class AdminController extends Controller
{
    public function index()
    {
        $view_data = [
            'title_tag' => 'Dashboard Admin',
            'H1_tag' => 'Liste des utilisateurs',
            'users' => AppRepoManager::getRm()->getUserRepo()->findAll()
        ];

        $view = new View('user/list');
        $view->titre = 'Tous les utilisateur';
        $view->render($view_data);
    }

    public function updateUser(int $id)
    {
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            'users' => AppRepoManager::getRm()->getUserRepo()->findById($id)
        ];

        $view = new View('user/update');
        $view->render($view_data);
    }

    public function updateU(ServerRequest $request): void
    {
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();

        if (empty($post_data['email']) || empty($post_data['role'])) {
            $form_result->addError(new FormError('Saisir tous les champs'));
        } else {
            $email = $post_data['email'];
            $role = $post_data['role'];
            $id = $post_data['id'];

            $user = AppRepoManager::getRm()->getUserRepo()->updateById($email, $role, $id);

            // Si il y a des erreurs
            if ($form_result->hasError()) {
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect('/admin/update_user/'. $id);
            }
            self::redirect('/admin');
        }
    }
}