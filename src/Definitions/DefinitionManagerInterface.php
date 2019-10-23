<?php
namespace PoP\Definitions\Definitions;

interface DefinitionManagerInterface
{
    public function getDefinitionResolver(): ?DefinitionResolverInterface;
    public function setDefinitionResolver(DefinitionResolverInterface $definition_resolver): void;
    public function setDefinitionPersistence(DefinitionPersistenceInterface $definition_persistence): void;
    public function getDefinitionPersistence(): ?DefinitionPersistenceInterface;
    public function getUniqueDefinition($name, $group): string;
    public function getDefinition($name, $group): string;
    public function getOriginalName($definition, $group): string;
    public function maybeStoreDefinitionsPersistently(): void;
}
