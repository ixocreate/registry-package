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

    public function id(): string
    {
        return $this->id;
    }

    public function value()
    {
        return $this->value;
    }

    /**
     * @return DefinitionCollection
     */
    protected static function createDefinitions(): DefinitionCollection
    {
        return new DefinitionCollection([
            new Definition('id', TypeInterface::TYPE_STRING),
            new Definition('value', TypeInterface::TYPE_STRING)
        ]);
    }

    /**
     * @param ClassMetadataBuilder $builder
     */
    public static function loadMetadata(ClassMetadataBuilder $builder)
    {
        $builder->setTable('registry_registry');

        $builder->createField('id', Type::STRING)->makePrimaryKey()->build();
        $builder->createField('value', Type::TEXT)->nullable(false)->build();
    }
}