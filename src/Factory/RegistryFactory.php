<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry\Factory;

use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Package\Database\Repository\Factory\RepositorySubManager;
use Ixocreate\Package\Registry\Registry;
use Ixocreate\Package\Registry\RegistrySubManager;
use Ixocreate\Package\Registry\Repository\RegistryRepository;
use Ixocreate\Package\Schema\Builder;

final class RegistryFactory implements FactoryInterface
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

        /** @var Builder $builder */
        $builder = $container->get(Builder::class);

        return new Registry($registryRepository, $registrySubManager, $builder);
    }
}
