<?php
namespace PoP\Definitions\Definitions;
use PoP\Definitions\Facades\DefinitionManagerFacade;

abstract class AbstractDefinitionPersistence implements DefinitionPersistenceInterface
{
    public function __construct()
    {
        DefinitionManagerFacade::getInstance()->setDefinitionPersistence($this);
    }
}
