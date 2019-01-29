<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Action;

use Ixocreate\Admin\Response\ApiSuccessResponse;
use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Schema\Listing\ListElement;
use Ixocreate\Schema\Listing\ListSchema;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IndexAction implements MiddlewareInterface
{
    /**
     * @var RegistrySubManager
     */
    private $registrySubManager;

    /**
     * IndexAction constructor.
     * @param RegistrySubManager $registrySubManager
     */
    public function __construct(RegistrySubManager $registrySubManager)
    {
        $this->registrySubManager = $registrySubManager;
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
        $registryList = [];

        foreach ($this->registrySubManager->getServices() as $entry) {
            /** @var RegistryEntryInterface $registryEntry */
            $registryEntry = $this->registrySubManager->get($entry);
            $registryList[] = ['id' => $registryEntry::serviceName()];
        }

        $sorting = null;

        $schema = (new ListSchema())
            ->withAddedElement(new ListElement('id', 'Bezeichnung'));

        $count = \count($registryList);

        return new ApiSuccessResponse(['schema' => $schema,'items' => $registryList, 'meta' => ['count' => $count]]);
    }
}