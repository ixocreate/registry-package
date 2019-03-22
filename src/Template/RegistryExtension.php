<?php

declare(strict_types=1);

namespace Ixocreate\Registry\Template;

use Ixocreate\Contract\Registry\RegistryInterface;
use Ixocreate\Contract\Template\ExtensionInterface;
use Ixocreate\Registry\Registry;

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
