<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use Ixocreate\Admin\Package\Config\AdminConfig;
use Ixocreate\Application\Http\Pipe\GroupPipeConfigurator;
use Ixocreate\Application\Http\Pipe\PipeConfigurator;
use Ixocreate\Registry\Package\Action\DetailAction;
use Ixocreate\Registry\Package\Action\IndexAction;
use Ixocreate\Registry\Package\Action\UpdateAction;

/** @var PipeConfigurator $pipe */

$pipe->segmentPipe(AdminConfig::class)(function (PipeConfigurator $pipe) {
    $pipe->segment('/api')(function (PipeConfigurator $pipe) {
        $pipe->group("admin.authorized")(function (GroupPipeConfigurator $pipe) {
            $pipe->get('/registry', IndexAction::class, 'admin.api.registry.index');
            $pipe->get('/registry/{id}', DetailAction::class, 'admin.api.registry.detail');
            $pipe->patch('/registry/{id}', UpdateAction::class, 'admin.api.registry.update');
        });
    });
});
