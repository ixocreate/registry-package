<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use Ixocreate\Registry\Package\Repository\RegistryRepository;

/** @var \Ixocreate\Database\Package\Repository\RepositoryConfigurator $repository */

$repository->addRepository(RegistryRepository::class);
