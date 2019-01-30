<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\CommonTypes\Entity\CollectionType;
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


    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
    }

    public function all(): ?array
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


    public function get(string $name)
    {
        $entry = $this->registryRepository->find($name);
        $value = null;
        if ($entry !== null) {
            $value = $entry->value()->value();
            if (\array_key_exists($name, $value) && $value[$name] instanceof CollectionType) {
                $return = [];
                foreach ($value[$name] as $item) {
                    foreach ($item->value() as $key => $itemValue) {
                        $return[$key] = $itemValue;
                    }
                }
                return $return;
            }
        }
        return $value;
    }
}