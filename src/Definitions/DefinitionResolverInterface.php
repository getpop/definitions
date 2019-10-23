<?php
namespace PoP\Definitions\Definitions;

interface DefinitionResolverInterface
{
    public function getDefinition($name, $group): string;
    public function getDataToPersist(): array;
    public function setPersistedData($persisted_data): void;
}
