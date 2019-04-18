<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Registry\Command\UpdateCommand;

/** @var \Ixocreate\CommandBus\Configurator $commandBus */
$commandBus->addCommand(UpdateCommand::class);
