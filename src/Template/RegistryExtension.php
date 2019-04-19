<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Template;

use Ixocreate\Registry\Registry;
use Ixocreate\Registry\RegistryInterface;
use Ixocreate\Template\Extension\ExtensionInterface;

final class RegistryExtension implements ExtensionInterface
{
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'registry';
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __invoke($name)
    {
        if ($this->registry->has($name)) {
            return $this->registry->get($name);
        }
        return null;
    }
}
