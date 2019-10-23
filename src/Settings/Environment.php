<?php
namespace PoP\Definitions\Settings;

class Environment
{
    public static function disableDefinitions()
    {
        return $_ENV['DISABLE_DEFINITIONS'] ? strtolower($_ENV['DISABLE_DEFINITIONS']) == "true" : false;
    }
    public static function disableDefinitionPersistence()
    {
        return $_ENV['DISABLE_DEFINITION_PERSISTENCE'] ? strtolower($_ENV['DISABLE_DEFINITION_PERSISTENCE']) == "true" : false;
    }
}

