<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry;

use \Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Package\Registry\Action\DetailAction;
use Ixocreate\Package\Registry\Action\IndexAction;
use Ixocreate\Package\Registry\Action\UpdateAction;

/** @var MiddlewareConfigurator $middleware */

$middleware->addAction(IndexAction::class);
$middleware->addAction(DetailAction::class);
$middleware->addAction(UpdateAction::class);
