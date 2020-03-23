<?php

require_once './vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use MimMarcelo\ContaContas\Helper\EntityManager;

return ConsoleRunner::createHelperSet(EntityManager::getEntityManager());
