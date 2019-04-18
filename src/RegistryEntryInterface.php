<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Schema\ElementInterface;
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface RegistryEntryInterface extends NamedServiceInterface
{
    public function label(): string;

    public function element(BuilderInterface $builder): ElementInterface;
}
