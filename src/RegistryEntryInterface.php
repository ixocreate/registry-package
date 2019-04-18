<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry;

use Ixocreate\Package\Schema\ElementInterface;
use Ixocreate\Package\Schema\BuilderInterface;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface RegistryEntryInterface extends NamedServiceInterface
{
    public function label(): string;

    public function element(BuilderInterface $builder): ElementInterface;
}
