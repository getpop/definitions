<?php

declare(strict_types=1);

namespace PoP\Definitions;

class Environment
{
    public static function disableDefinitions(): bool
    {
        return isset($_ENV['DISABLE_DEFINITIONS']) ?
            strtolower($_ENV['DISABLE_DEFINITIONS']) == "true" :
            false;
    }
    public static function disableDefinitionPersistence(): bool
    {
        return isset($_ENV['DISABLE_DEFINITION_PERSISTENCE']) ?
            strtolower($_ENV['DISABLE_DEFINITION_PERSISTENCE']) == "true" :
            false;
    }
}
