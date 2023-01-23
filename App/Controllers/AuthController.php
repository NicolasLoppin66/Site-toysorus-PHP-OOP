<?php

namespace App\Controllers;

use Core\View;
use App\Session;
use App\Models\User;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Laminas\Diactoros\ServerRequest;

// admin : doe@doe.com mdp : doe
// inscrit : toto@toto.com mdp : toto

class AuthController extends Controller
{

    public const AUTH_SALT = 'c56a7523d96942a834b9cdc249bd4e8c7aa9';

    public const AUTH_PEPPER = '8d746680fd4d7cbac57fa9f033115fc52196';

    public function index(): void
    {
        $view = new View('auth/login', true);

        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view->render($view_data);
    }

    public function login(ServerRequest $request): void
    {
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();
        $user = new User();

        // Si un des champs n'est pas remplis on ajoute l'erreur
        if (empty($post_data['email']) || empty($post_data['password'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        }
        // Sinon on compare les valeur en BDD
        else {
            $email = $post_data['email'];
            $password = self::hash($post_data['password']);

            // Appel au repository (SQL request)
            $user = AppRepoManager::getRm()->getUserRepo()->checkAuth($email, $password);

            // Si on n'a un retour négatif, on ajoute l'erreur
            if (is_null($user)) {
                $form_result->addError(new FormError('Email ou Mot de pass incorrect !'));
            }
        }
        // Si il y a des erreurs on renvois vers la page de connexion
        if ($form_result->hasError()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/connexion');
        }

        // Si tous est OK on enregistre la session
        $user->password = '';
        Session::set(Session::USER, $user);

        // Enfin, on redirige sur l'accueil
        self::redirect('/');
    }

    public function logout(): void
    {
        Session::remove(Session::USER);
        self::redirect('/');
    }

    public static function hash(string $str): string
    {
        $data = self::AUTH_SALT . $str . self::AUTH_PEPPER;
        return hash('sha512', $data);
    }

    public static function isAuth(): bool
    {
        return !is_null(Session::get(Session::USER));
    }

    private static function hasRole(int $role)
    {
        $user = Session::get(Session::USER);
        if (!($user instanceof User))
            return false;

        return $user->role === $role;
    }

    public static function isSubcriber()
    {
        return self::hasRole(User::ROLE_SUBCRIBER);
    }

    public static function isAdmin()
    {
        return self::hasRole(User::ROLE_ADMINISTRATOR);
    }
}