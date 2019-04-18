<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package\Config;

use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\Registry\Package\RegistryEntryInterface;
use Ixocreate\Registry\Package\RegistrySubManager;
use Ixocreate\ServiceManager\Factory\AutowireFactory;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;

final class RegistryConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * RegistryConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(RegistrySubManager::class, RegistryEntryInterface::class);
    }

    /**
     * @param string $registryEntry
     * @param string $factory
     */
    public function addEntry(string $registryEntry, string $factory = AutowireFactory::class): void
    {
        $this->subManagerConfigurator->addFactory($registryEntry, $factory);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addDirectory(string $directory, bool $recursive = true): void
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $this->subManagerConfigurator->registerService($serviceRegistry);
    }
}
