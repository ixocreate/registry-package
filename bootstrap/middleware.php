<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use \Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Registry\Action\DetailAction;
use Ixocreate\Registry\Action\IndexAction;
use Ixocreate\Registry\Action\UpdateAction;

/** @var MiddlewareConfigurator $middleware */

$middleware->addAction(IndexAction::class);
$middleware->addAction(DetailAction::class);
$middleware->addAction(UpdateAction::class);
