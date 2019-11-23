<?php
namespace PoP\Definitions;

class Environment
{
    public static function disableDefinitions(): bool
    {
        return $_ENV['DISABLE_DEFINITIONS'] ? strtolower($_ENV['DISABLE_DEFINITIONS']) == "true" : false;
    }
    public static function disableDefinitionPersistence(): bool
    {
        return $_ENV['DISABLE_DEFINITION_PERSISTENCE'] ? strtolower($_ENV['DISABLE_DEFINITION_PERSISTENCE']) == "true" : false;
    }
}

