<?php

namespace ZF3Belcebur\MaterializeCssHelper;

use Traversable;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|Traversable
     */
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}
