<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Contract\Registry\RegistryInterface;
use Ixocreate\Database\Repository\Factory\RepositorySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Schema\Builder;

final class Registry implements RegistryInterface
{

    private $registryRepository;
    /**
     * @var
     */
    private $registrySubManager;
    /**
     * @var
     */
    private $builder;

    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
    }

    public function has(string $name): bool
    {
        return $this->registrySubManager->has($name);
    }

    public function get(string $name)
    {
        return $this->registryRepository->find($name);
    }
}