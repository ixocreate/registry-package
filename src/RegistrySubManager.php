<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use Ixocreate\Type\Package\Entity\SchemaType;
use Ixocreate\Schema\Package\BuilderInterface;
use Ixocreate\Schema\Package\SchemaInterface;
use Ixocreate\Schema\Package\SchemaProviderInterface;
use Ixocreate\Schema\Package\Builder;
use Ixocreate\Schema\Package\Schema;
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
