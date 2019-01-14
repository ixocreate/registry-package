<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Registry\Repository\RegistryRepository;

/** @var \Ixocreate\Database\Repository\RepositoryConfigurator $repository */

$repository->addRepository(RegistryRepository::class);