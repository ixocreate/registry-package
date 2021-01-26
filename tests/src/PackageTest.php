<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Registry;

use Ixocreate\Registry\Package;
use Ixocreate\Registry\RegistryBootstrapItem;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Registry\Package
     */
    public function testPackage()
    {
        $package = new Package();

        $this->assertSame([RegistryBootstrapItem::class], $package->getBootstrapItems());

        $this->assertEmpty($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}
