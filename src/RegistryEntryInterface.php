<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Application\ServiceManager\NamedServiceInterface;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\ElementInterface;

interface RegistryEntryInterface extends NamedServiceInterface
{
    public function label(): string;

    public function element(BuilderInterface $builder): ElementInterface;
}
