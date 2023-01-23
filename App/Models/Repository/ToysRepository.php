<?php

namespace App\Models\Repository;

use App\AppRepoManager;
use App\Models\Brands;
use App\Models\Toys;
use Core\Repository;

class ToysRepository extends Repository
{
    public function getTableName(): string
    {
        return "toys";
    }

    public function findAll(): array
    {
        return $this->readAll(Toys::class);
    }

    public function findById(int $id): ?Toys
    {
        return $this->readById(Toys::class, $id);
    }

    public function findAllByBrand(int $id): ?array
    {
        $q = sprintf(
            'SELECT *
            FROM `%s`
            WHERE brand_id=:id',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);

        if (!$stmt)
            return null;

        $stmt->execute(['id' => $id]);

        while ($row_data = $stmt->fetch())
            $arr_result[] = new Toys($row_data);
        return $arr_result;
    }

    public function findByIdWithBrand(int $id): ?Toys
    {
        $q = sprintf(
            'SELECT `%1$s`.*, `%2$s`.name AS brand_name
            FROM `%1$s`
            INNER JOIN `%2$s`
            ON `%2$s`.id = `%1$s`.brand_id
            WHERE `%1$s`.id=:id',
            // On déclare les variable
            $this->getTableName(),
            AppRepoManager::getRm()->getBrandRepo()->getTableName(),
        );

        $stmt = $this->pdo->prepare($q);

        if (!$stmt)
            return null;

        $stmt->execute(['id' => $id]);

        $row_data = $stmt->fetch();

        if (empty($row_data))
            return null;

        // On vas utiliser l'hydratation (hydrator)
        $toy = new Toys($row_data);

        // On reconstitue un tableau de donnée
        // pour l'hydrateur de Brands
        $brand_data = [
            'id' => $toy->brand_id,
            'name' => $row_data['brand_name']
        ];

        // On crée l'objet Brand
        $brand = new Brands($brand_data);

        // On ajoute l'objet Brand à l'objet Toys
        $toy->brand = $brand;
        return $toy;
    }
}