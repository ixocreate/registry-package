<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Registry\Factory\RegistryFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addSubManager(RegistrySubManager::class);

$serviceManager->addFactory(RegistryInterface::class, RegistryFactory::class);
