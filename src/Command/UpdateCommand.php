<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Command;

use Ixocreate\CommandBus\Command\AbstractCommand;
use Ixocreate\CommonTypes\Entity\SchemaType;
use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Entity\Type\Type;
use Ixocreate\Registry\Entity\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Contract\CommandBus\CommandInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Schema;

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
     * UpdateCommand constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     * @param Builder $builder
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'registryUpdate';
    }

    /**
     * @return bool
     */
    public function execute(): bool
    {
        $data = $this->data();
        $registryEntry = null;

        foreach ($this->registrySubManager->getServices() as $service) {
            $entry = $this->registrySubManager->get($service);
            if ($entry::serviceName() !== $data['key']) {
                continue;
            }
            /** @var RegistryEntryInterface $registryEntry */
            $registryEntry = $entry;
            break;
        }

        $element = $registryEntry->element($this->builder);

        /** @var Schema $schema */
        $schema = (new Schema())->withAddedElement($element);
        /** @var SchemaType $schemaType */
        $schemaType = $schema->transform($data['data']);
        $value = $schemaType->convertToDatabaseValue();

        if (\class_exists($element->type())) {
            $type = Type::create($data, $element->type());
            $value = $type->convertToDatabaseValue();
        }

        if ($this->registryRepository->find($data['key']) === null ) {
            $entity = new Registry([
                'id' => $data['key'],
                'value' => $value,
            ]);

            $this->registryRepository->save($entity);
        } else {
            /** @var Registry $registry */
            $registry = $this->registryRepository->find($data['key']);
            $registry->with('value', $value);
        }

        return true;
    }
}