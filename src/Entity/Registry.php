<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Ixocreate\CommonTypes\Entity\DateTimeType;
use Ixocreate\CommonTypes\Entity\SchemaType;
use Ixocreate\Contract\Entity\DatabaseEntityInterface;
use Ixocreate\Contract\Type\TypeInterface;
use Ixocreate\Entity\Entity\Definition;
use Ixocreate\Entity\Entity\DefinitionCollection;
use Ixocreate\Entity\Entity\EntityInterface;
use Ixocreate\Entity\Entity\EntityTrait;

final class Registry implements EntityInterface, DatabaseEntityInterface
{
    use EntityTrait;

    private $id;

    private $value;

    private $createdAt;

    private $updatedAt;

    public function id(): string
    {
        return $this->id;
    }

    public function value()
    {
        return $this->value;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

    public function updatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return DefinitionCollection
     */
    protected static function createDefinitions(): DefinitionCollection
    {
        return new DefinitionCollection([
            new Definition('id', TypeInterface::TYPE_STRING),
            new Definition('value', SchemaType::class),
            new Definition('createdAt', DateTimeType::class),
            new Definition('updatedAt', DateTimeType::class),
        ]);
    }

    /**
     * @param ClassMetadataBuilder $builder
     */
    public static function loadMetadata(ClassMetadataBuilder $builder)
    {
        $builder->setTable('registry_registry');

        $builder->createField('id', Type::STRING)->makePrimaryKey()->build();
        $builder->createField('value', SchemaType::serviceName())->nullable(false)->build();
        $builder->createField('createdAt', DateTimeType::serviceName())->nullable(false)->build();
        $builder->createField('updatedAt', DateTimeType::serviceName())->nullable(false)->build();
    }
}