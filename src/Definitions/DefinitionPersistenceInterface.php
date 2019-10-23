<?php
namespace PoP\Definitions\Definitions;

interface DefinitionPersistenceInterface
{
    public function storeDefinitionsPersistently(): void;
    public function getSavedDefinition($name, $group): ?string;
    public function getOriginalName($definition, $group): ?string;
    public function saveDefinition($definition, $name, $group): void;
    public function setDefinitionResolver(DefinitionResolverInterface $definition_resolver): void;
}
