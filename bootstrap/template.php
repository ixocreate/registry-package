<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Package;

use Ixocreate\Registry\Package\Template\RegistryExtension;
use Ixocreate\Template\Package\TemplateConfigurator;

/** @var TemplateConfigurator $template */

$template->addExtension(RegistryExtension::class);
