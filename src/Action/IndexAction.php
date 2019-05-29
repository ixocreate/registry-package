<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Action;

use Ixocreate\Admin\Response\ApiSuccessResponse;
use Ixocreate\Registry\RegistryEntryInterface;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Schema\ListElement\TextListElement;
use Ixocreate\Schema\ListSchema\ListSchema;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements MiddlewareInterface
{
    /**
     * @var RegistrySubManager
     */
    private $registrySubManager;

    /**
     * IndexAction constructor.
     *
     * @param RegistrySubManager $registrySubManager
     */
    public function __construct(RegistrySubManager $registrySubManager)
    {
        $this->registrySubManager = $registrySubManager;
    }

    /**
     * Process an incoming server request.
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
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
            $registryList[] = ['id' => $registryEntry::serviceName(), 'label' => $registryEntry->label()];
        }

        $sorting = null;

        $schema = (new ListSchema())
            ->withAddedElement(new TextListElement('label', 'Bezeichnung', true, false));

        $count = \count($registryList);

        return new ApiSuccessResponse(['schema' => $schema, 'items' => $registryList, 'meta' => ['count' => $count]]);
    }
}
