<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Repository;

use Ixocreate\Database\Repository\AbstractRepository;
use Ixocreate\Registry\Entity\Registry;

class RegistryRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return Registry::class;
    }
}
