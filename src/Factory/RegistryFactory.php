<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Factory;

use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Database\Repository\Factory\RepositorySubManager;
use Ixocreate\Registry\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;

class RegistryFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var RepositorySubManager $test */
        $repositorySubManager = $container->get(RepositorySubManager::class);
        $registryRepository = $repositorySubManager->get(RegistryRepository::class);

        /** @var RegistrySubManager $registrySubManager */
        $registrySubManager = $container->get(RegistrySubManager::class);

        return new Registry($registryRepository, $registrySubManager);
    }
}