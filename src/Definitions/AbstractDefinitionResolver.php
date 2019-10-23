<?php
namespace PoP\Definitions\Definitions;
use PoP\Definitions\Facades\DefinitionManagerFacade;

abstract class AbstractDefinitionResolver implements DefinitionResolverInterface
{
    public function __construct()
    {
        DefinitionManagerFacade::getInstance()->setDefinitionResolver($this);
    }
}
