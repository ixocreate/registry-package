<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use \Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Registry\Package\Action\DetailAction;
use Ixocreate\Registry\Package\Action\IndexAction;
use Ixocreate\Registry\Package\Action\UpdateAction;

/** @var MiddlewareConfigurator $middleware */

$middleware->addAction(IndexAction::class);
$middleware->addAction(DetailAction::class);
$middleware->addAction(UpdateAction::class);
