<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Registry\RegistryInterface;
use Ixocreate\Registry\Factory\RegistryFactory;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(RegistrySubManager::class);

$serviceManager->addFactory(RegistryInterface::class, RegistryFactory::class);

