<?php

namespace MimMarcelo\ContaContas\Helper;
require_once __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;

/**
 *
 */
trait EntityManager
{
    public static function getEntityManager(): \Doctrine\ORM\EntityManager
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = false;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../Model/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        );

        // obtaining the entity manager
        return \Doctrine\ORM\EntityManager::create($conn, $config);
    }
}
