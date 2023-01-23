<?php

namespace App\Models\Repository;

use App\AppRepoManager;
use App\Models\Brands;
use Core\Repository;

class BrandsRepository extends Repository
{
    public function getTableName(): string
    {
        return 'brands';
    }

    public function getBrandByName(): ?array
    {
        $q_brand = sprintf(
            'SELECT `%1$s`.name, `%1$s`.id, 
            COUNT(`%1$s`.id) AS total_brand
            FROM `%1$s`
            INNER JOIN `%2$s`
            ON `%1$s`.id = `%2$s`.brand_id
            GROUP BY `%1$s`.id',

            $this->getTableName(),
            AppRepoManager::getRm()->getToyRepo()->getTableName()
        );

        $stmt_brand = $this->pdo->query($q_brand);
        if (!$stmt_brand)
            return null;
        while ($row_data_brand = $stmt_brand->fetch())
            $r_brand[] = new Brands($row_data_brand);
        /** @var @brand $r_brand */
        return $r_brand;
    }
}