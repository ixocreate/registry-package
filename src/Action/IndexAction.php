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
        $query = $request->getQueryParams();
        $offset = (\array_key_exists('offset', $query)) ? (int)$query['offset'] : 0;
        $limit = (\array_key_exists('limit', $query)) ? (int)$query['limit'] : 0;
        $search = (\array_key_exists('search', $query)) ? $query['search'] : '';
        $filter = (\array_key_exists('filter', $query)) ? $query['filter'] : [];


        $registryList = [];

        foreach ($this->registrySubManager->services() as $key => $entry) {
            /** @var RegistryEntryInterface $registryEntry */
            $registryEntry = $this->registrySubManager->get($entry);
            $registryList[] = ['id' => $registryEntry::serviceName(), 'label' => $registryEntry->label()];
        }

        $input = '';
        if ($search) {
            $input = $search;
        }
        if (isset($filter['label'])) {
            $input = $filter['label'];
        }
        if ($input) {
            $haystack = [];
            foreach ($registryList as $key => $entry) {
                $haystack[$key] = $entry['label'];
            }
            $input = \preg_quote($input, '~');
            $result = \preg_grep('/' . $input . '/i', $haystack);
            if ($result) {
                foreach ($result as $key => $entry) {
                    $newResult[] = $registryList[$key];
                }
                $registryList = $newResult;
            }
        }

        $registryList = \array_slice($registryList, $offset, $limit);

        $count = \count($registryList);

        $schema = (new ListSchema())
            ->withAddedElement(new TextListElement('label', 'Bezeichnung', true, true));

        return new ApiSuccessResponse(['schema' => $schema, 'items' => $registryList, 'meta' => ['count' => $count]]);
    }
}
