<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry;

use Ixocreate\Registry\Template\RegistryExtension;
use Ixocreate\Template\TemplateConfigurator;

/** @var TemplateConfigurator $template */

$template->addExtension(RegistryExtension::class);
