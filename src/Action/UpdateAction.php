<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package\Action;

use Ixocreate\Admin\Package\Response\ApiErrorResponse;
use Ixocreate\Admin\Package\Response\ApiSuccessResponse;
use Ixocreate\CommandBus\CommandBus;
use Ixocreate\Registry\Package\Command\UpdateCommand;
use Ixocreate\Registry\Package\RegistrySubManager;
use Ixocreate\Registry\Package\Repository\RegistryRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class UpdateAction implements MiddlewareInterface
{
    /**
     * @var RegistryRepository
     */
    private $registryRepository;

    /**
     * @var RegistrySubManager
     */
    private $registrySubManager;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * UpdateAction constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     * @param CommandBus $commandBus
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, CommandBus $commandBus)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->commandBus = $commandBus;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = [
            'id' => $request->getAttribute('id'),
            'data' => $request->getParsedBody(),
        ];

        $createCommand = $this->commandBus->create(UpdateCommand::class, $data);
        $commandResult = $this->commandBus->dispatch($createCommand);

        if (!$commandResult->isSuccessful()) {
            return new ApiErrorResponse('execution_error', $commandResult->messages());
        }

        return new ApiSuccessResponse(['id' => $data['id']]);
    }
}
