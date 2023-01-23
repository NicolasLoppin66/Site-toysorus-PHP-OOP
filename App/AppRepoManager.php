<?php

namespace App;

use Core\RepositoryManagerTrait;
use App\Models\Repository\ToysRepository;
use App\Models\Repository\UserRepository;
use App\Models\Repository\BrandsRepository;

class AppRepoManager
{
    // On utiliser le trait
    use RepositoryManagerTrait;

    private UserRepository $userRepository;

    public function getUserRepo(): UserRepository
    {
        return $this->userRepository;
    }

    private ToysRepository $toysRepository;

    public function getToyRepo(): ToysRepository
    {
        return $this->toysRepository;
    }

    private BrandsRepository $brandsRepository;

    public function getBrandRepo(): BrandsRepository
    {
        return $this->brandsRepository;
    }

    public function __construct()
    {
        $config = App::getApp();
        
        $this->userRepository = new UserRepository($config);
        $this->toysRepository = new ToysRepository($config);
        $this->brandsRepository = new BrandsRepository($config);
    }
}