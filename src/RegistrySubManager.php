<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry;

use Ixocreate\Package\Type\Entity\SchemaType;
use Ixocreate\Package\Registry\RegistryEntryInterface;
use Ixocreate\Package\Schema\BuilderInterface;
use Ixocreate\Package\Schema\SchemaInterface;
use Ixocreate\Package\Schema\SchemaProviderInterface;
use Ixocreate\Package\Schema\Builder;
use Ixocreate\Package\Schema\Schema;
use Ixocreate\ServiceManager\SubManager\SubManager;

final class RegistrySubManager extends SubManager implements SchemaProviderInterface
{
    /**
     * @param $name
     * @param Builder $builder
     * @param array $options
     * @return SchemaInterface
     */
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        /** @var RegistryEntryInterface $registryEntry */
        $registryEntry = $this->get($name);

        $element = $registryEntry->element($builder);

        if ($element->inputType() === SchemaType::class) {
            return (new Schema())->withElements($element->elements());
        }

        return (new Schema())->withAddedElement($element);
    }
}
