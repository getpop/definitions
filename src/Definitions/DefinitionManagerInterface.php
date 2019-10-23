<?php
namespace PoP\Definitions\Definitions;

interface DefinitionManagerInterface
{
    public function getDefinitionResolver(): ?DefinitionResolver;
    public function setDefinitionResolver(DefinitionResolver $definition_resolver): void;
    public function setDefinitionPersistence(DefinitionPersistence $definition_persistence): void;
    public function getUniqueDefinition($name, $group): string;
    public function getDefinition($name, $group): string;
    public function getOriginalName($definition, $group): string;
}
