<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Action;

use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Registry\Entity\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Registry\Response\RegistryDetailResponse;
use Ixocreate\Schema\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DetailAction implements MiddlewareInterface
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
     * @var Builder
     */
    private $builder;

    /**
     * DetailAction constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     * @param Builder $builder
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
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
        $key = $request->getAttribute('key');
        $registryEntry = null;

        foreach ($this->registrySubManager->getServices() as $service) {
            $entry = $this->registrySubManager->get($service);
            if ($entry::serviceName() !== $key) {
                continue;
            }
            /** @var RegistryEntryInterface $registryEntry */
            $registryEntry = $entry;
            break;
        }

        /** @var Registry $registry */
        $registry = $this->registryRepository->find($key);


        return new RegistryDetailResponse(
            $registryEntry,
            $registry->jsonSerialize(),
            []
        );
    }
}