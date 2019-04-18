<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Type\Entity\SchemaType;
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\SchemaInterface;
use Ixocreate\Schema\SchemaProviderInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Schema;
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
