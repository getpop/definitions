<?php

declare(strict_types=1);

namespace PoP\Definitions;

interface DefinitionResolverInterface
{
    public function getDefinition($name, $group): string;
    public function getDataToPersist(): array;
    public function setPersistedData($persisted_data): void;
}
