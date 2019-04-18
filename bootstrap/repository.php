<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry;

use Ixocreate\Package\Registry\Repository\RegistryRepository;

/** @var \Ixocreate\Package\Database\Repository\RepositoryConfigurator $repository */

$repository->addRepository(RegistryRepository::class);
