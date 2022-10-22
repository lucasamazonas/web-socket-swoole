<?php

namespace App\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator {

    /**
     * @throws ORMException
     */
    public static function createEntityManager(): EntityManager
    {
        $isDevMode = true;

        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/../Entity"],
            $isDevMode
        );

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        );

        return EntityManager::create($conn, $config);
    }
}