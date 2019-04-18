<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry\Repository;

use Ixocreate\Package\Database\Repository\AbstractRepository;
use Ixocreate\Package\Registry\Entity\Registry;

final class RegistryRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return Registry::class;
    }
}
