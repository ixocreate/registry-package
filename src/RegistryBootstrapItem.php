<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Configurator\ConfiguratorInterface;

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
