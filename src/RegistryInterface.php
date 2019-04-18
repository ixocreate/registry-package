<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

interface RegistryInterface
{
    public function all(): array;

    public function has(string $name): bool;

    public function get(string $name);
}
