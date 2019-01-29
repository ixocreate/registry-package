<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Action;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Ixocreate\Admin\Response\ApiDetailResponse;
use Ixocreate\Admin\Response\ApiSuccessResponse;
use Ixocreate\CommonTypes\Entity\CollectionType;
use Ixocreate\CommonTypes\Entity\SchemaType;
use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\GroupInterface;
use Ixocreate\Contract\Schema\SingleElementInterface;
use Ixocreate\Contract\Schema\TransformableInterface;
use Ixocreate\Entity\Type\Type;
use Ixocreate\Registry\Entity\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Registry\Response\RegistryDetailResponse;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Elements\AbstractGroup;
use Ixocreate\Schema\Elements\AbstractSingleElement;
use Ixocreate\Schema\Schema;
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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DetailAction constructor.
     * @param RegistryRepository $registryRepository
     * @param RegistrySubManager $registrySubManager
     * @param Builder $builder
     * @param EntityManagerInterface $master
     */
    public function __construct(RegistryRepository $registryRepository, RegistrySubManager $registrySubManager, Builder $builder, EntityManagerInterface $master)
    {
        $this->registryRepository = $registryRepository;
        $this->registrySubManager = $registrySubManager;
        $this->builder = $builder;
        $this->entityManager = $master;
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
        $id = $request->getAttribute('id');

        /** @var Registry $registry */
        $registry = $this->registryRepository->find($id);

        $schema = $this->registrySubManager->provideSchema($id, $this->builder);

        $items = [];

        if ($registry !== null){
            $items = $registry->toPublicArray();
        }

        return new RegistryDetailResponse(
            $schema,
            $items,
            []
        );
    }
}