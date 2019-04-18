<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Type\Entity\SchemaType;
use Ixocreate\Schema\StructuralGroupingInterface;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Schema\Builder;

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
     * @var Builder
     */
    private $builder;

    /**
     * Registry constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
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
        /** @var RegistryEntryInterface $entry */
        $entry = $this->registrySubManager->get($name);
        $element = $entry->element($this->builder);

        $entity = $this->registryRepository->find($name);
        $value = null;
        if ($entity !== null) {
            $value = $entity->value();
            if ($element->inputType() !== SchemaType::class) {
                $value = $value->value();
            }
            if (!$element instanceof StructuralGroupingInterface) {
                return \array_pop($value);
            }
            return $value;
        }
        return $value;
    }
}
