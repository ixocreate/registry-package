<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ixocreate\CommandBus\Command\AbstractCommand;
use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Entity\Type\Type;
use Ixocreate\Registry\Entity\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Contract\CommandBus\CommandInterface;
use Ixocreate\Schema\Builder;

class UpdateCommand extends AbstractCommand implements CommandInterface
{

    /**
     * @var RegistryRepository
     */
    private $registryRepository;
    /**
     * @var RegistrySubManager
     */
    private $registrySubManager;
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ChangeAttributesCommand constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     * @param Builder $builder
     * @param EntityManagerInterface $master
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder, EntityManagerInterface $master)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
        $this->entityManager = $master;
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'registryUpdate';
    }


    public function execute(): bool
    {
        $data = $this->data();
        $key = $data['key'];
        $registryEntry = null;

        foreach ($this->registrySubManager->getServices() as $service) {
            $entry = $this->registrySubManager->get($service);
            if ($entry::serviceName() !== $key) {
                continue;
            }
            /** @var RegistryEntryInterface $registryEntry */
            $registryEntry = $entry;
            break;
        }
        /** @var ElementInterface $element */
        $element = $registryEntry->element($this->builder);

        /** @var Type $type */
        $elementType = $element->type();

        /** @var \Doctrine\DBAL\Types\Type $baseType */
        $baseType = \Doctrine\DBAL\Types\Type::getType($elementType);

        $databaseValue = $baseType->convertToDatabaseValue($data['data'][$key], $this->entityManager->getConnection()->getDatabasePlatform());

        /** @var Registry $registry */
        $registry = $this->registryRepository->find($key);
        $entity = $registry->with('value', $databaseValue);

        if ($registry === null) {
            $entity = new Registry ([
                'id' => $key,
                'value' => $databaseValue,
            ]);
        }

        $this->registryRepository->save($entity);

        return true;
    }
}