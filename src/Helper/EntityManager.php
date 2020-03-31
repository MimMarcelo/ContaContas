<?php

namespace MimMarcelo\ContaContas\Helper;
require_once __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;

/**
 *
 */
class EntityManager
{
    /**
     * @var type Doctrine\ORM\EntityManager
     */
    private static $entityManager;

    public static function getEntityManager(): \Doctrine\ORM\EntityManager
    {
        if(is_null(EntityManager::$entityManager)){
            EntityManager::$entityManager = EntityManager::createEntityManager();
        }
        return EntityManager::$entityManager;
    }

    private static function createEntityManager(): \Doctrine\ORM\EntityManager
    {
        $isDevMode = false;
        $proxyDir = null;
        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $useSimpleAnnotationReader = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../Model/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'Senha12#',
            'dbname' => 'contacontas',
        );

        // obtaining the entity manager
        return \Doctrine\ORM\EntityManager::create($conn, $config);
    }
}
