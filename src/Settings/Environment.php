<?php
namespace PoP\Definitions\Settings;

class Environment
{
    public static function disableDefinitionResolver()
    {
        return $_ENV['DISABLE_DEFINITION_RESOLVER'] ? strtolower($_ENV['DISABLE_DEFINITION_RESOLVER']) == "true" : false;
    }
}

