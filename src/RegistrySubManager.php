<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Contract\Schema\SchemaProviderInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Schema;
use Ixocreate\ServiceManager\SubManager\SubManager;

class RegistrySubManager extends SubManager implements SchemaProviderInterface
{
    public function provideSchema($name, Builder $builder, $options = []): SchemaInterface
    {
        /** @var RegistryEntryInterface $registryEntry */
        $registryEntry = $this->get($name);

        return (new Schema())->withAddedElement($registryEntry->element($builder));
    }
}