<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use Ixocreate\Registry\Package\Command\UpdateCommand;

/** @var \Ixocreate\CommandBus\Package\Configurator $commandBus */
$commandBus->addCommand(UpdateCommand::class);
