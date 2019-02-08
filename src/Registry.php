<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Contract\Registry\RegistryInterface;
use Ixocreate\Registry\Repository\RegistryRepository;

final class Registry implements RegistryInterface
{
    /**
     * @var RegistryRepository
     */
    private $registryRepository;

    /**
     * @var
     */
    private $registrySubManager;

    /**
     * Registry constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $array = [];
        foreach ($this->registrySubManager->getServices() as $service) {
            $array[] = $this->registrySubManager->get($service)::serviceName();
        }
        return $array;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->registrySubManager->has($name);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function get(string $name)
    {
        $entity = $this->registryRepository->find($name);
        $value = null;
        if ($entity !== null) {
            $value = $entity->value()->value();
            // TODO: maybe check on some interface instead of counting
            if (\count($value) == 1) {
                return \array_pop($value);
            }
            return $value;
        }
        return $value;
    }
}