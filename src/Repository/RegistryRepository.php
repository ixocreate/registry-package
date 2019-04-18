<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package\Repository;

use Ixocreate\Database\Package\Repository\AbstractRepository;
use Ixocreate\Registry\Package\Entity\Registry;

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
