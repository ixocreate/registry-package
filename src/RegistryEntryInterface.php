<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\ElementInterface;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface RegistryEntryInterface extends NamedServiceInterface
{
    public function label(): string;

    public function element(BuilderInterface $builder): ElementInterface;
}
