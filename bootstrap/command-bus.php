<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\CommandBus\CommandBusConfigurator;
use Ixocreate\Registry\Command\UpdateCommand;

/** @var CommandBusConfigurator $commandBus */

$commandBus->addCommand(UpdateCommand::class);
