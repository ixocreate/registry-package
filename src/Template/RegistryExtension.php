<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry\Template;

use Ixocreate\Package\Registry\RegistryInterface;
use Ixocreate\Template\ExtensionInterface;
use Ixocreate\Package\Registry\Registry;

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
