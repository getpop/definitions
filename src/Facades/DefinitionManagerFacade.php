<?php
namespace PoP\Definitions\Facades;

use PoP\Definitions\DefinitionManagerInterface;
use PoP\Root\Container\ContainerBuilderFactory;

class DefinitionManagerFacade
{
    public static function getInstance(): DefinitionManagerInterface
    {
        return ContainerBuilderFactory::getInstance()->get('definition_manager');
    }
}
