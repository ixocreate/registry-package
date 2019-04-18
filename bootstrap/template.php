<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry;

use Ixocreate\Package\Registry\Template\RegistryExtension;
use Ixocreate\Package\Template\TemplateConfigurator;

/** @var TemplateConfigurator $template */

$template->addExtension(RegistryExtension::class);
