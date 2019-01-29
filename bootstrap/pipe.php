<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Admin\Config\AdminConfig;
use Ixocreate\ApplicationHttp\Pipe\GroupPipeConfigurator;
use Ixocreate\ApplicationHttp\Pipe\PipeConfigurator;
use Ixocreate\Registry\Action\DetailAction;
use Ixocreate\Registry\Action\IndexAction;
use Ixocreate\Registry\Action\UpdateAction;

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