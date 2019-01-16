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
use Ixocreate\Contract\Registry\RegistryEntryInterface;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\SingleElementInterface;
use Ixocreate\Registry\Entity\Registry;
use Ixocreate\Registry\RegistrySubManager;
use Ixocreate\Registry\Repository\RegistryRepository;
use Ixocreate\Registry\Response\RegistryDetailResponse;
use Ixocreate\Schema\Builder;
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
     * @throws \Doctrine\DBAL\DBALException
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
        /** @var ElementInterface $element */
        $element = $registryEntry->element($this->builder);

        $schema = $element;

        if ($element instanceof SingleElementInterface) {
            $schema = (new Schema())->withAddedElement($element);
        }

        /** @var Registry $registry */
        $registry = $this->registryRepository->find($key);

        $phpValue = null;
        if ($registry !== null) {
            /** @var Type $elementType */
            $elementType = $element->type();
            /** @var \Doctrine\DBAL\Types\Type $baseType */
            $baseType = \Doctrine\DBAL\Types\Type::getType($elementType);

            $phpValue = $baseType->convertToPHPValue($registry->value(), $this->entityManager->getConnection()->getDatabasePlatform());
        }

        return new RegistryDetailResponse(
            $schema,
            $phpValue,
            []
        );
    }
}