<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\BootstrapItem;

use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Registry\Config\RegistryConfigurator;

final class RegistryBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new RegistryConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'registry';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'registry.php';
    }
}
